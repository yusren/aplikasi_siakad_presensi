<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KrsController extends Controller
{
    public function getUsersByRoleAndTahunAjaran($role, $tahunAjaranId)
    {
        return User::where('role', $role)
            ->whereHas('krs', function ($query) use ($tahunAjaranId) {
                $query->where('tahun_ajaran_id', $tahunAjaranId);
            })
            ->with(['krs' => function ($query) use ($tahunAjaranId) {
                $query->where('tahun_ajaran_id', $tahunAjaranId);
            }])
            ->get();
    }

    public function index(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId);

        if (auth()->user()->role == 'mahasiswa') {
            return view('krs.user.index', [
                'users' => auth()->user(),
                'krs' => auth()->user()->krs->where('tahun_ajaran_id', $tahunAjaranId),
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        } else {
            return view('krs.index', [
                'users' => $users,
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        }
    }

    public function indexDetailprodi(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId)
            ->groupBy(function ($item, $key) {
                return $item->kelas->first()->prodi->name;
            });

        if (auth()->user()->role == 'mahasiswa') {
            return view('krs.user.index', [
                'users' => auth()->user(),
                'krs' => auth()->user()->krs->where('tahun_ajaran_id', $tahunAjaranId)->where('status', 'menunggu'),
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        } else {
            return view('krs.detail.prodi.index', [
                'users' => $users,
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        }
    }

    public function indexDetailkelas(Request $request)
    {
        $prodi = $request->prodi;
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId)
            ->filter(function ($item) use ($prodi) {
                return $item->kelas->first()->prodi->id == $prodi;
            })
            ->groupBy(function ($item, $key) {
                return $item->kelas->first()->name;
            });

        return view('krs.detail.kelas.index', [
            'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
            'users' => $users,
        ]);
    }

    public function indexDetailmahasiswa(Request $request)
    {
        $kelas = $request->kelas;
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId)
            ->filter(function ($item) use ($kelas) {
                return $item->kelas->first()->id == $kelas;
            });

        return view('krs.detail.mahasiswa.index', [
            'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('krs.create', [
            'kelas' => Kelas::get(),
            'prodi' => Prodi::get(),
            'matakuliah' => Matakuliah::get(),
            'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // $prodi = Prodi::findOrFail($request->prodi_id);
        $kelas = Kelas::findOrFail($request->kelas_id);

        // foreach ($prodi->kelas as $kelas) {
        foreach ($kelas->users as $user) {
            foreach ($request->matakuliah as $mk) {
                Krs::create([
                    'user_id' => $user->id,
                    'matakuliah_id' => $mk,
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    'semester' => $request->semester,
                ]);
            }
        }
        // }

        return redirect(route('krs.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Krs $kr)
    {
        return view('krs.show', compact('krs'));
    }

    public function pengajuanKrs(Request $request)
    {
        $krsCollection = auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        foreach ($krsCollection as $krs) {
            $krs->update(['status' => 'ajukan']);
        }

        return redirect(route('krs.index'))->with('toast_success', 'Krs Berhasil Di Ajukan!');
    }

    public function rekap(Request $request)
    {
        return view('krs.rekap', [
            'krs' => auth()->user()->krs->sortBy('tahunAjaran'),
            'bobot_tugas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_tugas'],
            'bobot_uts' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uts'],
            'bobot_uas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uas'],
            'bobot_keaktifan' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_keaktifan'],

        ]);
    }
}
