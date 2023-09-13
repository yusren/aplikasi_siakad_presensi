<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
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
        $krs = auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        $bobot_tugas = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_tugas'];
        $bobot_uts = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uts'];
        $bobot_uas = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uas'];
        $bobot_keaktifan = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_keaktifan'];

        $totalScore = 0;
        $totalSks = 0;

        foreach ($krs as $value) {
            $score = (($bobot_tugas / 100) * $value->nilai_tugas) + (($bobot_uts / 100) * $value->nilai_uts) + (($bobot_uas / 100) * $value->nilai_uas) + (($bobot_keaktifan / 100) * $value->nilai_keaktifan);
            $totalScore += $score * $value->matakuliah->sks;
            $totalSks += $value->matakuliah->sks;
        }

        $ip = $totalScore / $totalSks;
        $ipk = $this->getTotalScoreAllSemesters() / $this->getTotalSksAllSemesters();

        return view('print.khs', [
            'totalScore' => $totalScore,
            'bobot_tugas' => $bobot_tugas,
            'bobot_uts' => $bobot_uts,
            'bobot_uas' => $bobot_uas,
            'bobot_keaktifan' => $bobot_keaktifan,
            'krs' => $krs,
            'tahunAjaran' => TahunAjaran::find($request->tahun_ajaran_id),
            'ip' => number_format($ip, 2),
            'ipk' => number_format($ipk, 2),
        ]);
    }

    public function getTotalScoreAllSemesters()
    {
        $totalScore = 0;
        $bobot_tugas = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_tugas'];
        $bobot_uts = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uts'];
        $bobot_uas = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uas'];
        $bobot_keaktifan = json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_keaktifan'];

        foreach (auth()->user()->krs as $krs) {
            $score = (($bobot_tugas / 100) * $krs->nilai_tugas) + (($bobot_uts / 100) * $krs->nilai_uts) + (($bobot_uas / 100) * $krs->nilai_uas) + (($bobot_keaktifan / 100) * $krs->nilai_keaktifan);
            $totalScore += $score * $krs->matakuliah->sks;
        }

        return $totalScore;
    }

    public function getTotalSksAllSemesters()
    {
        return auth()->user()->krs->sum('matakuliah.sks');
    }

    // public function convertScoreToBobot($score)
    // {
    //     if ($score >= 90) return 4;
    //     if ($score >= 85) return 3.75;
    //     if ($score >= 80) return 3.5;
    //     if ($score >= 75) return 3.25;
    //     if ($score >= 70) return 3;
    //     if ($score >= 65) return 2.75;
    //     if ($score >= 60) return 2.5;
    //     if ($score >= 55) return 2;
    //     if ($score >= 45) return 1.75;
    //     if ($score >= 40) return 1.5;
    //     if ($score >= 35) return 1.25;
    //     if ($score >= 30) return 1;

    //     return 0; // score <30
    // }

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
