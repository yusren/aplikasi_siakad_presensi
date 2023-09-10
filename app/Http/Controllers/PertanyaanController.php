<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Pertanyaan::create([
            'angket_id' => $request->angket_id,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect(route('angket.show', $request->angket_id))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        return view('pertanyaan.edit', ['pertanyaan' => $pertanyaan]);
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $pertanyaan->update([
            'angket_id' => $request->angket_id,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect(route('angket.show', $request->angket_id))->with('toast_success', 'Berhasil Merubah Data!');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();

        return redirect()->back()->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
