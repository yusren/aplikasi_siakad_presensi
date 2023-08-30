<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatakuliahRequest;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    public function index()
    {
        return view('matakuliah.index', [
            'matakuliah' => Matakuliah::get(),
        ]);
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(MatakuliahRequest $request)
    {
        $data = $request->validated();
        Matakuliah::create($data);

        return redirect(route('matakuliah.index'))->with('toast_success', 'Berhasil Menyimpan Data!');

    }

    public function show(Matakuliah $matakuliah)
    {
        dd($matakuliah);
    }

    public function edit(Matakuliah $matakuliah)
    {
        return view('matakuliah.edit', ['matakuliah' => $matakuliah]);
    }

    public function update(MatakuliahRequest $request, Matakuliah $matakuliah)
    {
        $data = $request->validated();
        $matakuliah->update($data);

        return redirect(route('matakuliah.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect(route('matakuliah.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
