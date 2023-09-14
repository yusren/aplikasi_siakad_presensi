<?php

namespace App\Http\Controllers;

use App\Models\Angket;
use App\Models\HasilAngket;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $angket = Angket::where('kondisi', $request->kondisi)->get();

        return view('test.index', [
            'angket' => $angket,
        ]);
    }

    public function show($id)
    {
        $angket = Angket::find($id);

        return view('test.show', ['angket' => $angket, 'hasilAngket' => auth()->user()->hasilAngket->where('angket_id', $angket->id)->first()]);
    }

    public function update(Request $request, $id)
    {
        $angket = Angket::with(['pertanyaan', 'pertanyaan.jawaban'])->find($id);

        HasilAngket::updateOrCreate(
            ['user_id' => auth()->id(), 'angket_id' => $angket->id],
            ['data_jawaban' => json_encode($request->except(['_method', '_token']))]
        );

        return redirect()->route('test.show', $angket->id)->with('toast_success', 'Berhasil Menyimpan Data!');
    }
}
