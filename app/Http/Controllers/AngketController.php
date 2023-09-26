<?php

namespace App\Http\Controllers;

use App\Http\Requests\AngketRequest;
use App\Models\Angket;
use App\Models\Matakuliah;
use App\Models\Prodi;

class AngketController extends Controller
{
    public function index()
    {
        return view('angket.index', [
            'angket' => Angket::get(),
        ]);
    }

    public function create()
    {
        $pilihan = [
            'semua_user', //mahasiswa, dosen dll
            'dosen',
            'karyawan',
            'dosen_karyawan',
            'mahasiswa',
        ];

        return view('angket.create', ['matakuliah' => Matakuliah::get(), 'prodi' => Prodi::get(), 'pilihan' => $pilihan]);
    }

    public function store(AngketRequest $request)
    {
        $data = $request->validated();
        $data['matakuliahs'] = isset($data['matakuliah']) ? json_encode($data['matakuliah']) : null;
        $data['prodi'] = isset($data['prodi']) ? json_encode($data['prodi']) : null;
        Angket::create($data);

        return redirect(route('angket.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Angket $angket)
    {
        return view('angket.show', ['angket' => $angket]);
    }

    public function edit(Angket $angket)
    {
        $pilihan = [
            'semua_user', //mahasiswa, dosen dll
            'dosen',
            'karyawan',
            'dosen_karyawan',
            'mahasiswa',
        ];

        return view('angket.edit', ['angket' => $angket, 'matakuliah' => Matakuliah::get(), 'prodi' => Prodi::get(), 'pilihan' => $pilihan]);
    }

    public function update(AngketRequest $request, Angket $angket)
    {
        $data = $request->validated();
        $angket->update($data);

        return redirect(route('angket.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Angket $angket)
    {
        $angket->delete();

        return redirect(route('angket.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
