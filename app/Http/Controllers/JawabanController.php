<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
    public function index(Request $request)
    {
        $pertanyaan = Pertanyaan::find($request->pertanyaan_id);
        $pertanyaans = Pertanyaan::where('angket_id', $pertanyaan->angket_id)->get();

        $jawaban = $request->pertanyaan_id ? Jawaban::where('pertanyaan_id', $request->pertanyaan_id)->get() : Jawaban::get();

        return view('jawaban.index', compact('pertanyaan', 'pertanyaans', 'jawaban'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pertanyaan_id' => 'required',
            'answer_text' => 'required',
        ]);

        $data = $request->all();

        Jawaban::create($data);

        return redirect(route('jawaban.index', ['pertanyaan_id' => $data['pertanyaan_id']]))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Jawaban $jawaban)
    {
        //
    }

    public function edit(jawaban $jawaban)
    {
        $pertanyaans = Pertanyaan::get();

        return view('jawaban.edit', compact('jawaban', 'pertanyaans'));
    }

    public function update(Request $request, jawaban $jawaban)
    {
        $this->validate($request, [
            'pertanyaan_id' => 'required',
            'answer_text' => 'required',
        ]);

        $data = $request->all();
        $jawaban->update($data);

        return redirect(route('jawaban.index', ['pertanyaan_id' => $data['pertanyaan_id']]))->with('toast_success', 'Berhasil Mengubah Data!');
    }

    public function destroy(jawaban $jawaban)
    {
        $pertanyaan_id = $jawaban->pertanyaan_id;
        $jawaban->delete();

        return redirect(route('jawaban.index', ['pertanyaan_id' => $pertanyaan_id]))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
