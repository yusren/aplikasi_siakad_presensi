<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalRequest;
use App\Models\Fakultas;
use App\Models\Jadwal;
use App\Models\Ruang;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);
        $krs = $user->krs->where('tahun_ajaran_id', $tahunAjaranId);
        $matakuliahIds = $krs->pluck('matakuliah_id')->toArray();
        $jadwal = Jadwal::where('tahun_ajaran_id', $tahunAjaranId)
            ->whereHas('kelas.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->whereIn('matakuliah_id', $matakuliahIds)
            ->get();
        $tahunAjaran = TahunAjaran::orderBy('name')->get();

        switch (auth()->user()->role) {
            case 'mahasiswa':
                return view('jadwal.user.index', ['jadwal' => $jadwal, 'tahunAjaranAktif' => $tahunAjaranAktif, 'tahunAjaran' => $tahunAjaran]);
            case 'dosen':
                $jadwal = Jadwal::where('user_id', $user->id)->where('tahun_ajaran_id', $tahunAjaranId)->whereHas('matakuliah.user', function ($query) {
                    $query->where('id', auth()->id());
                })->get();

                return view('jadwal.dosen.index', ['jadwal' => $jadwal, 'tahunAjaranAktif' => $tahunAjaranAktif, 'tahunAjaran' => $tahunAjaran]);
            default:
                return view('jadwal.index', ['jadwal' => Jadwal::get()]);
        }
    }

    public function create()
    {
        return view('jadwal.create', [
            'tahunAjaran' => TahunAjaran::get(),
            'fakultas' => Fakultas::get(),
            'dosen' => User::where('role', 'dosen')->get(),
            'ruangan' => Ruang::get(),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        ]);
    }

    public function store(JadwalRequest $request)
    {
        $data = $request->validated();
        Jadwal::create($data);

        return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Jadwal $jadwal)
    {
        dd($jadwal);
    }

    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.edit', [
            'jadwal' => $jadwal,
            'tahunAjaran' => TahunAjaran::get(),
            'fakultas' => Fakultas::get(),
            'dosen' => User::where('role', 'dosen')->get(),
            'ruangan' => Ruang::get(),
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        ]);
    }

    public function update(JadwalRequest $request, Jadwal $jadwal)
    {
        $data = $request->validated();
        $jadwal->update($data);

        return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect(route('jadwal.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
