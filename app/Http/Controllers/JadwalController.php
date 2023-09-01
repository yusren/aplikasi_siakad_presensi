<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalRequest;
use App\Models\Jadwal;

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
        return view('jadwal.create');
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
        return view('jadwal.edit', ['jadwal' => $jadwal]);
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
