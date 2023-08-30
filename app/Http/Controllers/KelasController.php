<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;

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
        return view('kelas.create');
    }

    public function store(KelasRequest $request)
    {
        $data = $request->validated();
        Kelas::create($data);

        return redirect(route('kelas.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Kelas $kela)
    {
        dd($kela);
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', ['kelas' => $kela]);
    }

    public function update(KelasRequest $request, Kelas $kela)
    {
        $data = $request->validated();
        $kela->update($data);

        return redirect(route('kelas.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect(route('kelas.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
