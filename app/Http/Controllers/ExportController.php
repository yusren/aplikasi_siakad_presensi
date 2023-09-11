<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'bobot_tugas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_tugas'],
            'bobot_uts' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uts'],
            'bobot_uas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uas'],
            'bobot_keaktifan' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_keaktifan'],
            'krs' => auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id),
            'tahunAjaran' => TahunAjaran::find($request->tahun_ajaran_id),
        ]);
    }
}
