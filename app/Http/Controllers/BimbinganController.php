<?php

namespace App\Http\Controllers;

use App\Http\Requests\BimbinganRequest;
use App\Models\Bimbingan;
use App\Models\TahunAjaran;

class BimbinganController extends Controller
{
    public function index()
    {
        return view('bimbingan.index', [
            'bimbingan' => Bimbingan::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function create()
    {
        return view('bimbingan.create', [
            'tahunAjaran' => TahunAjaran::get(),
        ]);
    }

    public function store(BimbinganRequest $request)
    {
        $data = $request->validated();
        Bimbingan::create($data);

        return redirect(route('bimbingan.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Bimbingan $bimbingan)
    {
        return view('bimbingan.show', ['bimbingan' => $bimbingan, 'tahunAjaran' => TahunAjaran::get()]);
    }

    public function edit(Bimbingan $bimbingan)
    {
        return view('bimbingan.edit', ['bimbingan' => $bimbingan, 'tahunAjaran' => TahunAjaran::get()]);
    }

    public function update(BimbinganRequest $request, Bimbingan $bimbingan)
    {
        $data = $request->validated();
        $bimbingan->update($data);

        return redirect(route('bimbingan.index'))->with('toast_success', 'Berhasil Mengubah Data!');
    }

    public function destroy(Bimbingan $bimbingan)
    {
        $bimbingan->delete();

        return redirect(route('bimbingan.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
