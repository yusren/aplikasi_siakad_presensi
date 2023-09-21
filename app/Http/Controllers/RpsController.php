<?php

namespace App\Http\Controllers;

use App\Http\Requests\RpsRequest;
use App\Models\Rps;

class RpsController extends Controller
{
    public function index()
    {
        return view('rps.index', [
            'rps' => Rps::get(),
        ]);
    }

    public function create()
    {
        return view('rps.create');
    }

    public function store(RpsRequest $request)
    {
        $data = $request->validated();
        Rps::create($data);

        return redirect(route('rps.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Rps $rp)
    {
        dd($rp->detail);
    }

    public function edit(Rps $rp)
    {
        return view('rps.edit', ['rp' => $rp]);
    }

    public function update(RpsRequest $request, Rps $rp)
    {
        $data = $request->validated();
        $rp->update($data);

        return redirect(route('rps.index'))->with('toast_success', 'Berhasil Mengubah Data!');
    }

    public function destroy(Rps $rp)
    {
        $rp->delete();

        return redirect(route('rps.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
