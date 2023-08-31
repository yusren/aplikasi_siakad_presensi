<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuangRequest;
use App\Models\Ruang;

class RuangController extends Controller
{
    public function index()
    {
        return view('ruang.index', [
            'ruang' => Ruang::get(),
        ]);
    }

    public function create()
    {
        return view('ruang.create');
    }

    public function store(RuangRequest $request)
    {
        $data = $request->validated();
        Ruang::create($data);

        return redirect(route('ruang.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Ruang $ruang)
    {
        dd($ruang);
    }

    public function edit(Ruang $ruang)
    {
        return view('ruang.edit', ['ruang' => $ruang]);
    }

    public function update(RuangRequest $request, Ruang $ruang)
    {
        $data = $request->validated();
        $ruang->update($data);

        return redirect(route('ruang.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Ruang $ruang)
    {
        $ruang->delete();

        return redirect(route('ruang.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
