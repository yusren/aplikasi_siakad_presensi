<?php

namespace App\Http\Controllers;

use App\Http\Requests\FakultasRequest;
use App\Models\Fakultas;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::get();

        return view('fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(FakultasRequest $request)
    {
        $data = $request->validated();
        Fakultas::create($data);

        return redirect(route('fakultas.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Fakultas $fakulta)
    {
        dd($fakulta);
    }

    public function edit(Fakultas $fakulta)
    {
        return view('fakultas.edit', ['fakultas' => $fakulta]);
    }

    public function update(FakultasRequest $request, Fakultas $fakulta)
    {
        $data = $request->validated();
        $fakulta->update($data);

        return redirect(route('fakultas.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Fakultas $fakulta)
    {
        $fakulta->delete();

        return redirect(route('fakultas.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
