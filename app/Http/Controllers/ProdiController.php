<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdiRequest;
use App\Models\Fakultas;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\User;

class ProdiController extends Controller
{
    public function getMatakuliah($prodi_id)
    {
        $matakuliah = Matakuliah::with('prodi', 'user')->where('prodi_id', $prodi_id)->get();

        return response()->json($matakuliah);
    }

    public function getKelas($prodi_id)
    {
        $kelas = Kelas::where('prodi_id', $prodi_id)->get();

        return response()->json($kelas);
    }

    public function index()
    {
        return view('prodi.index', [
            'prodi' => Prodi::get(),
            'dosen' => User::where('role', 'dosen')->get(),
        ]);
    }

    public function create()
    {
        return view('prodi.create', [
            'fakultas' => Fakultas::get(),
        ]);
    }

    public function store(ProdiRequest $request)
    {
        $data = $request->validated();
        Prodi::create($data);

        return redirect(route('prodi.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Prodi $prodi)
    {
        dd($prodi);
    }

    public function edit(Prodi $prodi)
    {
        return view('prodi.edit', [
            'prodi' => $prodi,
            'dosen' => User::where('role', 'dosen')->get(),
            'fakultas' => Fakultas::get(),
        ]);
    }

    public function update(ProdiRequest $request, Prodi $prodi)
    {
        $data = $request->validated();
        $prodi->update($data);

        return redirect(route('prodi.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();

        return redirect(route('prodi.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
