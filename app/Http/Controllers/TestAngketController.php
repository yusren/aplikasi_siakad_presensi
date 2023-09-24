<?php

namespace App\Http\Controllers;

use App\Models\Angket;
use App\Models\HasilAngket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestAngketController extends Controller
{
    public function index(Request $request)
    {
        $userAngkets = Auth::user()->hasilAngket->pluck('angket_id');
        if (! in_array(Auth::user()->role, ['superadmin', 'admin', 'lpm', 'kaprodi', 'birokeuangan'])) {
            $angket = Angket::where('kondisi', $request->kondisi)->whereNotIn('id', $userAngkets)->get();
        } else {
            $angket = Angket::get();
        }

        if (auth()->user()->role == 'mahasiswa') {
            return view('test.user.index', [
                'angket' => $angket,
            ]);
        } else {
            return view('test.index', [
                'angket' => $angket,
            ]);
        }
    }

    public function show($id)
    {
        $angket = Angket::find($id);

        if (auth()->user()->role == 'mahasiswa') {
            return view('test.user.show', ['angket' => $angket, 'hasilAngket' => auth()->user()->hasilAngket->where('angket_id', $angket->id)->first()]);
        } else {
            return view('test.show', ['angket' => $angket, 'hasilAngket' => auth()->user()->hasilAngket->where('angket_id', $angket->id)->first()]);
        }
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
