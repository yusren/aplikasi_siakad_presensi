<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $matakuliahId = $request->input('matakuliah_id', Matakuliah::where('user_id', auth()->id())->first()->id);
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);
        $matakuliahAktif = Matakuliah::find($matakuliahId);
        $users = User::with(['krs' => function ($query) use ($tahunAjaranId, $matakuliahId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId)
                ->where('matakuliah_id', $matakuliahId);
        }])->whereHas('krs', function ($query) use ($tahunAjaranId, $matakuliahId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId)
                ->where('matakuliah_id', $matakuliahId);
        })->get();

        return view('input.index', [
            'bobot_tugas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_tugas'],
            'bobot_uts' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uts'],
            'bobot_uas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uas'],
            'bobot_keaktifan' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_keaktifan'],
            'users' => $users,
            'matakuliah' => Matakuliah::where('user_id', auth()->id())->get(),
            'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            'matakuliahAktif' => $matakuliahAktif,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ]);
    }

    public function indexDetailprodi(Request $request)
    {
        return $this->indexDetail($request, 'prodi');
    }

    public function indexDetailkelas(Request $request)
    {
        return $this->indexDetail($request, 'kelas');
    }

    public function indexDetailmatakuliah(Request $request)
    {
        return $this->indexDetail($request, 'matakuliah');
    }

    private function getusers($tahunAjaranId)
    {
        return User::with(['krs' => function ($query) use ($tahunAjaranId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId);
        }])->whereHas('krs', function ($query) use ($tahunAjaranId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId);
        })->get();
    }

    private function indexDetail(Request $request, ?string $groupKey)
    {
        $prodi = $request->prodi;
        $kelas = $request->kelas;
        $matakuliah = $request->matakuliah;
        $tahunAjaranId = $request->get('tahun_ajaran_id', TahunAjaran::where('is_active', true)->latest()->first()->id);

        switch ($groupKey) {
            case 'prodi':
                $users = $this->getusers($tahunAjaranId)->groupBy(function ($item, $key) {
                    return $item->kelas->first()->prodi->name;
                });
                break;

            case 'kelas':
                $users = $this->getusers($tahunAjaranId)->filter(function ($item) use ($prodi) {
                    return $item->kelas->first()->prodi->id == $prodi;
                })->groupBy(function ($item, $key) {
                    return $item->kelas->first()->name;
                });
                break;

            case 'matakuliah':
                $users = $this->getusers($tahunAjaranId)->filter(function ($item) use ($kelas) {
                    return $item->kelas->first()->id == $kelas;
                });

                $filteredUsers = $users->filter(function ($item) use ($kelas) {
                    return $item->kelas->first()->id == $kelas;
                });

                $groupedUsers = $filteredUsers->flatMap(function ($user) {
                    return $user->krs->map(function ($krs) use ($user) {
                        $matakuliah = $krs->matakuliah()->where('user_id', auth()->id())->first();

                        return $matakuliah ? [
                            'user' => $user,
                            'matakuliah' => $matakuliah->name,
                            'matakuliahCode' => $matakuliah->code,
                            'matakuliahId' => $matakuliah->id,
                        ] : null;
                    });
                })->filter();

                $users = $groupedUsers->groupBy('matakuliah');
                break;

            default:
                $users = $this->getusers($tahunAjaranId);
                break;
        }

        return view("input.dosen.{$groupKey}.index", [
            'users' => $users,
            'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
            'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            'bobot_tugas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_tugas'],
            'bobot_uts' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uts'],
            'bobot_uas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uas'],
            'bobot_keaktifan' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_keaktifan'],
        ]);
    }

    public function store(Request $request)
    {
        $krsIds = $request->input('krs_id');
        $nilaiTugas = $request->input('nilai_tugas');
        $nilaiUts = $request->input('nilai_uts');
        $nilaiUas = $request->input('nilai_uas');
        $nilaiKeaktifan = $request->input('nilai_keaktifan');
        foreach ($krsIds as $index => $krsId) {
            $krs = Krs::findOrFail($krsId);
            if ($krs) {
                $krs->update([
                    'nilai_tugas' => $nilaiTugas[$index],
                    'nilai_uts' => $nilaiUts[$index],
                    'nilai_uas' => $nilaiUas[$index],
                    'nilai_keaktifan' => $nilaiKeaktifan[$index],
                ]);
            }
        }

        return redirect()->route('nilai.index')->with('success', 'Data updated successfully');
    }
}
