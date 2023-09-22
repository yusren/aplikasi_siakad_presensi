<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengumumanRequest;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('pengumuman.index', [
            'pengumuman' => Pengumuman::get(),
        ]);
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(PengumumanRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time().'.'.$cover->getClientOriginalExtension();
            $cover->storeAs('public/covers', $coverName);
            $coverPath = 'storage/covers/'.$coverName;
        }
        $data['cover'] = $coverPath;
        Pengumuman::create($data);

        return redirect(route('pengumuman.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Pengumuman $pengumuman)
    {
        dd($pengumuman->toArray());
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', ['pengumuman' => $pengumuman]);
    }

    public function update(PengumumanRequest $request, Pengumuman $pengumuman)
    {
        $data = $request->validated();
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time().'.'.$cover->getClientOriginalExtension();
            $cover->storeAs('public/covers', $coverName);
            $coverPath = 'storage/covers/'.$coverName;
        }
        $data['cover'] = $coverPath;
        $pengumuman->update($data);

        return redirect(route('pengumuman.index'))->with('toast_success', 'Berhasil Mengubah Data!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect(route('pengumuman.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
