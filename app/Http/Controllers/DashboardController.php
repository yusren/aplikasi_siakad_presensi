<?php

namespace App\Http\Controllers;

use App\Models\Angket;
use App\Models\Pengumuman;
use App\Models\Pertanyaan;
use App\Models\User;
use App\Services\NilaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    protected $nilaiService;

    public function __construct(NilaiService $nilaiService)
    {
        $this->nilaiService = $nilaiService;
    }

    public function index(Request $request)
    {
        $users = User::whereHas('krs')->where('role', 'mahasiswa')->get(); // Get all users with role 'mahasiswa'

        $nilaiService = new NilaiService();
        $ipkCategories = ['>3.50', '3.00 - 3.49', '<3.00'];
        $ipkData = [0, 0, 0]; // Initialize IPK data

        foreach ($users as $user) {
            $krs = $user->krs; // Get the user's KRS data
            $totalScore = $nilaiService->getTotalScoreAllSemesters($krs);
            $totalSks = $nilaiService->getTotalSksAllSemesters($krs);

            $ipk = $totalScore / $totalSks;

            // Now you have the user's IPK, you can categorize it
            if ($ipk > 3.50) {
                $ipkData[0]++;
            } elseif ($ipk >= 3.00 && $ipk <= 3.49) {
                $ipkData[1]++;
            } else {
                $ipkData[2]++;
            }
        }

        $angkets = Angket::with('hasil')->get();
        $results = [];

        foreach ($angkets as $angket) {
            $pertanyaans = Pertanyaan::where('angket_id', $angket->id)->with('jawaban')->get();
            foreach ($pertanyaans as $pertanyaan) {
                $counts = collect($angket->hasil)
                    ->map(function ($hasil) use ($pertanyaan) {
                        $answers = json_decode($hasil->data_jawaban, true);

                        return $answers[$pertanyaan->id] ?? null;
                    })
                    ->countBy();
                $results[] = [
                    'angket_id' => $angket->id,
                    'pertanyaan_id' => $pertanyaan->id,
                    'description' => $pertanyaan->description,
                    'jawaban' => $counts->map(function ($count, $jawabanId) use ($pertanyaan) {
                        $jawaban = $pertanyaan->jawaban()->find($jawabanId);

                        return $jawaban ? ['answer_text' => $jawaban->answer_text, 'count' => $count] : null;
                    })->values(),
                ];
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['angkets' => $results]);
        }

        $news = Pengumuman::get();
        $pengumuman = [];

        foreach ($news as $p) {
            $users = json_decode($p->users, true);
            $kelas = json_decode($p->kelas, true);
            $prodi = json_decode($p->prodi, true);
            $role = json_decode($p->role, true);

            if (($users && in_array(auth()->user()->id, $users)) ||
                ($role && in_array(auth()->user()->role, $role)) ||
                (auth()->user()->role == 'mahasiswa' &&
                    (($kelas && in_array(auth()->user()->kelas->first()->id, $kelas)) ||
                        ($prodi && in_array(auth()->user()->prodi->id, $prodi))))
            ) {
                $pengumuman[] = $p;
            }
        }

        if (auth()->user()->role == 'mahasiswa') {
            return view('dashboard.user.index', ['pengumuman' => $pengumuman]);
        } else {
            return view('dashboard.index', [
                'ipkCategories' => $ipkCategories,
                'ipkData' => $ipkData,
                'angkets' => $angkets,
                'pertanyaans' => Pertanyaan::get(),
                'provinces' => \Indonesia::allProvinces(),
                'users' => User::count(),
                'mhs' => User::where('role', 'mahasiswa')->count(),
                'dosen' => User::where('role', 'dosen')->count(),
                'karyawan' => User::where('role', 'karyawan')->count(),
                'mhs_pria' => User::where('role', 'mahasiswa')->where('jenis_kelamin', 'laki-laki')->count(),
                'mhs_wanita' => User::where('role', 'mahasiswa')->where('jenis_kelamin', 'perempuan')->count(),
                'mhs_islam' => User::where('role', 'mahasiswa')->where('agama', 'islam')->count(),
                'mhs_kristen' => User::where('role', 'mahasiswa')->where('agama', 'kristen')->count(),
                'mhs_katolik' => User::where('role', 'mahasiswa')->where('agama', 'katolik')->count(),
                'mhs_hindu' => User::where('role', 'mahasiswa')->where('agama', 'hindu')->count(),
                'mhs_budha' => User::where('role', 'mahasiswa')->where('agama', 'budha')->count(),
                'mhs_konghucu' => User::where('role', 'mahasiswa')->where('agama', 'konghucu')->count(),
                'pengumuman' => $pengumuman,
            ]);
        }
    }

    public function setting()
    {
        $bobot = $this->nilaiService->getBobot();

        return view('dashboard.setting', [
            'baak' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak'],
            'baak_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak_nomor'],
            'baak_status' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak_status'],
            'keuangan' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'],
            'keuangan_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_nomor'],
            'keuangan_status' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_status'],
            'bobot_tugas' => $bobot['bobot_tugas'],
            'bobot_uts' => $bobot['bobot_uts'],
            'bobot_uas' => $bobot['bobot_uas'],
            'bobot_keaktifan' => $bobot['bobot_keaktifan'],
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
