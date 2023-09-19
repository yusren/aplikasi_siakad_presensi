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
            $score = (($bobot['bobot_tugas'] / 100) * $value->nilai_tugas) + (($bobot['bobot_uts'] / 100) * $value->nilai_uts) + (($bobot['bobot_uas'] / 100) * $value->nilai_uas) + (($bobot['bobot_keaktifan'] / 100) * $value->nilai_keaktifan);
            $totalScore += $this->convertScoreToBobot($score) * $value->matakuliah->sks;
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

    public function convertScoreToBobot($score)
    {
        $settings = json_decode(Storage::disk('public')->get('settings.json'), true);
        $range_bobot = [
            'A' => $settings['A'],
            'A-' => $settings['A-'],
            'B+' => $settings['B+'],
            'B' => $settings['B'],
            'B-' => $settings['B-'],
            'C+' => $settings['C+'],
            'C' => $settings['C'],
            'C-' => $settings['C-'],
            'D' => $settings['D'],
        ];

        if ($score >= $range_bobot['A']) {
            return 4;
        }
        if ($score >= $range_bobot['A-']) {
            return 3.75;
        }
        if ($score >= $range_bobot['B+']) {
            return 3.5;
        }
        if ($score >= $range_bobot['B']) {
            return 3.25;
        }
        if ($score >= $range_bobot['B-']) {
            return 3;
        }
        if ($score >= $range_bobot['C+']) {
            return 2.75;
        }
        if ($score >= $range_bobot['C']) {
            return 2.5;
        }
        if ($score >= $range_bobot['C-']) {
            return 2;
        }
        if ($score >= $range_bobot['D']) {
            return 1.75;
        }

        return 0;
    }
}
