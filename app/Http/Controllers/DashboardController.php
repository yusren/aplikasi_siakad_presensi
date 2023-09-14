<?php

namespace App\Http\Controllers;

use App\Models\Angket;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $angket = Angket::with('hasil')->first();
        $pertanyaans = Pertanyaan::where('angket_id', $angket->id)->with('jawaban')->get();
        $results = [];

        foreach ($pertanyaans as $pertanyaan) {
            $counts = collect($angket->hasil)
                ->map(function ($hasil) use ($pertanyaan) {
                    $answers = json_decode($hasil->data_jawaban, true);

                    return $answers[$pertanyaan->id] ?? null;
                })
                ->countBy();

            $results[] = [
                'pertanyaan_id' => $pertanyaan->id,
                'description' => $pertanyaan->description,
                'jawaban' => $counts->map(function ($count, $jawabanId) use ($pertanyaan) {
                    $jawaban = $pertanyaan->jawaban()->find($jawabanId);

                    return $jawaban ? ['answer_text' => $jawaban->answer_text, 'count' => $count] : null;
                })->values(),
            ];
        }

        if ($request->wantsJson()) {
            return response()->json(['angkets' => $results]);
        }

        if (auth()->user()->role == 'mahasiswa') {
            return view('dashboard.user.index', []);
        } else {
            return view('dashboard.index', [
                'users' => User::count(),
            ]);
        }
    }

    public function setting()
    {
        return view('dashboard.setting', [
            'baak' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak'],
            'baak_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak_nomor'],
            'baak_status' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak_status'],
            'keuangan' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'],
            'keuangan_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_nomor'],
            'keuangan_status' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_status'],
            'bobot_tugas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_tugas'],
            'bobot_uts' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uts'],
            'bobot_uas' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_uas'],
            'bobot_keaktifan' => json_decode(Storage::disk('public')->get('settings.json'), true)['bobot_keaktifan'],
            'grade_boundaries' => [
                'A' => json_decode(Storage::disk('public')->get('settings.json'), true)['A'],
                'A-' => json_decode(Storage::disk('public')->get('settings.json'), true)['A-'],
                'B+' => json_decode(Storage::disk('public')->get('settings.json'), true)['B+'],
                'B' => json_decode(Storage::disk('public')->get('settings.json'), true)['B'],
                'B-' => json_decode(Storage::disk('public')->get('settings.json'), true)['B-'],
                'C+' => json_decode(Storage::disk('public')->get('settings.json'), true)['C+'],
                'C' => json_decode(Storage::disk('public')->get('settings.json'), true)['C'],
                'C-' => json_decode(Storage::disk('public')->get('settings.json'), true)['C-'],
                'D' => json_decode(Storage::disk('public')->get('settings.json'), true)['D'],
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'baak' => 'required',
            'baak_nomor' => 'required',
            'baak_status' => 'required',
            'keuangan' => 'required',
            'keuangan_nomor' => 'required',
            'keuangan_status' => 'required',
            'bobot_tugas' => 'required',
            'bobot_uts' => 'required',
            'bobot_uas' => 'required',
            'bobot_keaktifan' => 'required',
            'A' => 'required',
            'A-' => 'required',
            'B+' => 'required',
            'B' => 'required',
            'B-' => 'required',
            'C+' => 'required',
            'C' => 'required',
            'C-' => 'required',
            'D' => 'required',
        ]);

        Storage::disk('public')->put('settings.json', json_encode($data));

        return redirect(route('setting'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }
}
