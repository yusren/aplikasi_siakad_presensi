<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function printKrs(Request $request)
    {
        return view('print.krs', [
            'krs' => auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id),
        ]);
    }

    public function printKhs(Request $request)
    {
        return view('print.khs', [
            'krs' => auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id),
            'tahunAjaran' => TahunAjaran::find($request->tahun_ajaran_id),
        ]);
    }
}
