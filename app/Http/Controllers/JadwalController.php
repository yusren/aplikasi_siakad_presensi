<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalRequest;
use App\Models\Fakultas;
use App\Models\Jadwal;
use App\Models\Ruang;
use App\Models\TahunAjaran;
use App\Models\User;

class JadwalController extends Controller
{
    public function index()
    {
        return view('jadwal.index', [
            'jadwal' => Jadwal::get(),
        ]);
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

        return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
