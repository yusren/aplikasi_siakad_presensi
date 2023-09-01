<?php

namespace App\Http\Controllers;

use App\Http\Requests\TahunAjaranRequest;
use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        return view('tahunajaran.index', [
            'tahunajaran' => TahunAjaran::get()->sortBy('name'),
        ]);
    }

    public function create()
    {
        return view('tahunajaran.create');
    }

    public function store(TahunAjaranRequest $request)
    {
        $data = $request->validated();
        TahunAjaran::create($data);

        return redirect(route('tahunajaran.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(TahunAjaran $tahunajaran)
    {
        dd($tahunajaran);
    }

    public function edit(TahunAjaran $tahunajaran)
    {
        return view('tahunajaran.edit', ['tahunajaran' => $tahunajaran]);
    }

    public function update(TahunAjaranRequest $request, TahunAjaran $tahunajaran)
    {
        $data = $request->validated();
        $tahunajaran->update($data);

        return redirect(route('tahunajaran.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(TahunAjaran $tahunajaran)
    {
        $tahunajaran->delete();

        return redirect(route('tahunajaran.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
