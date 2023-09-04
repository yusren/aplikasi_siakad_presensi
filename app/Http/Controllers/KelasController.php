<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\User;

class KelasController extends Controller
{
    public function index()
    {
        return view('kelas.index', [
            'kelas' => Kelas::get(),
        ]);
    }

    public function create()
    {
        return view('kelas.create', [
            'dosen' => User::where('role', 'dosen')->get(),
            'mahasiswa' => User::where('role', 'mahasiswa')->get(),
            'prodi' => Prodi::get(),
        ]);
    }

    public function store(KelasRequest $request)
    {
        $data = $request->validated();
        $kelas = Kelas::create($data);
        $kelas->users()->attach($data['mahasiswa']);

        return redirect(route('kelas.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Kelas $kela)
    {
        dd($kela);
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', [
            'kelas' => $kela,
            'dosen' => User::where('role', 'dosen')->get(),
            'mahasiswa' => User::where('role', 'mahasiswa')->get(),
            'prodi' => Prodi::get(),
        ]);
    }

    public function update(KelasRequest $request, Kelas $kela)
    {
        $data = $request->validated();
        $kela->update($data);
        $kela->users()->sync($data['mahasiswa']);

        return redirect(route('kelas.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect(route('kelas.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
