<?php

namespace App\Http\Controllers;

use App\Http\Requests\AngketRequest;
use App\Models\Angket;

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
        return view('angket.create');
    }

    public function store(AngketRequest $request)
    {
        $data = $request->validated();
        Angket::create($data);

        return redirect(route('angket.index'))->with('toast_success', 'Berhasil Menyimpan Data!');

    }

    public function show(Angket $angket)
    {
        dd($angket);
    }

    public function edit(Angket $angket)
    {
        return view('angket.edit', ['angket' => $angket]);
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
