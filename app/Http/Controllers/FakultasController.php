<?php

namespace App\Http\Controllers;

use App\Http\Requests\FakultasRequest;
use App\Models\Fakultas;
use App\Models\Prodi;

class FakultasController extends Controller
{
    public function getProdi($fakultas_id)
    {
        $prodi = Prodi::where('fakultas_id', $fakultas_id)->get();

        return response()->json($prodi);
    }

    public function index()
    {
        return view('fakultas.index', [
            'fakultas' => Fakultas::get(),
        ]);
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

        return redirect(route('fakultas.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
