<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class NilaiService
{
    public function getBobot()
    {
        $settings = json_decode(Storage::disk('public')->get('settings.json'), true);

        return [
            'bobot_tugas' => $settings['bobot_tugas'],
            'bobot_uts' => $settings['bobot_uts'],
            'bobot_uas' => $settings['bobot_uas'],
            'bobot_keaktifan' => $settings['bobot_keaktifan'],
        ];
    }

    public function calculateScore($krs, $bobot)
    {
        $totalScore = 0;
        foreach ($krs as $value) {
            $score = (($bobot['bobot_tugas'] / 100) * $value->nilai_tugas) +
                (($bobot['bobot_uts'] / 100) * $value->nilai_uts) +
                (($bobot['bobot_uas'] / 100) * $value->nilai_uas) +
                (($bobot['bobot_keaktifan'] / 100) * $value->nilai_keaktifan);
            $totalScore += $score * $value->matakuliah->sks;
        }

        return $totalScore;
    }

    public function getTotalScoreAllSemesters($krs)
    {
        $bobot = $this->getBobot();

        return $this->calculateScore($krs, $bobot);
    }

    public function getTotalSksAllSemesters($krs)
    {
        return $krs->sum('matakuliah.sks');
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
}
