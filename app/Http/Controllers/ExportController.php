<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\TahunAjaran;
use App\Services\NilaiService;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    protected $nilaiService;

    public function __construct(NilaiService $nilaiService)
    {
        $this->nilaiService = $nilaiService;
    }

    public function printKrs(Request $request)
    {
        return view('print.krs', [
            'krs' => auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id),
        ]);
    }

    public function printKhs(Request $request)
    {
        $krs = auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        $bobot = $this->nilaiService->getBobot();
        $totalScore = $this->nilaiService->calculateScore($krs, $bobot);
        $totalSks = $this->nilaiService->getTotalSksAllSemesters($krs);

        $ip = $totalScore / $totalSks;
        $ipk = $this->nilaiService->getTotalScoreAllSemesters(auth()->user()->krs) / $this->nilaiService->getTotalSksAllSemesters(auth()->user()->krs);

        return view('print.khs', [
            'totalScore' => $totalScore,
            'bobot_tugas' => $bobot['bobot_tugas'],
            'bobot_uts' => $bobot['bobot_uts'],
            'bobot_uas' => $bobot['bobot_uas'],
            'bobot_keaktifan' => $bobot['bobot_keaktifan'],
            'krs' => $krs,
            'tahunAjaran' => TahunAjaran::find($request->tahun_ajaran_id),
            'ip' => number_format($ip, 2),
            'ipk' => number_format($ipk, 2),
        ]);
    }

    public function printJurnalDosen(Request $request)
    {
        $jadwal = Jadwal::where([
            ['matakuliah_id', $request->matakuliah_id],
            ['kelas_id', $request->kelas_id],
            ['tahun_ajaran_id', $request->tahun_ajaran_id],
        ])->first();

        return view('print.jurnaldosen', [
            'jadwal' => $jadwal,
        ]);
    }
}
