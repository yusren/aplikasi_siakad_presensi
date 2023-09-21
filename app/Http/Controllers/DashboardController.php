<?php

namespace App\Http\Controllers;

use App\Models\Angket;
use App\Models\Pengumuman;
use App\Models\Pertanyaan;
use App\Models\User;
use App\Services\NilaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class DashboardController extends Controller
{
    protected $nilaiService;

    public function __construct(NilaiService $nilaiService)
    {
        $this->nilaiService = $nilaiService;
    }

    public function index(Request $request)
    {
        $usersAlamat = User::where('role', 'mahasiswa')
            ->with('alamats')
            ->get()
            ->groupBy([
                'jenis_kelamin',
                function ($item) {
                    $province = Province::find($item->alamats->provinsi);

                    return $province ? $province->name : 'Unknown';
                },
                function ($item) {
                    $city = City::find($item->alamats->kota);

                    return $city ? $city->name : 'Unknown';
                },
                function ($item) {
                    $district = District::find($item->alamats->kecamatan);

                    return $district ? $district->name : 'Unknown';
                },
            ])
            ->map(function ($items) {
                return $items->map(function ($items) {
                    return $items->map(function ($items) {
                        return $items->map(function ($items) {
                            return $items->count();
                        });
                    });
                });
            });
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
            return view('dashboard.user.index', ['pengumuman' => Pengumuman::where('role', 'mahasiswa')->get()]);
        } else {
            return view('dashboard.index', [
                'data' => $usersAlamat,
                'users' => User::count(),
                'mhs' => User::where('role', 'mahasiswa')->count(),
                'dosen' => User::where('role', 'dosen')->count(),
                'mhs_pria' => User::where('role', 'mahasiswa')->where('jenis_kelamin', 'laki-laki')->count(),
                'mhs_wanita' => User::where('role', 'mahasiswa')->where('jenis_kelamin', 'perempuan')->count(),
                'mhs_islam' => User::where('role', 'mahasiswa')->where('agama', 'islam')->count(),
                'mhs_kristen' => User::where('role', 'mahasiswa')->where('agama', 'kristen')->count(),
                'mhs_katolik' => User::where('role', 'mahasiswa')->where('agama', 'katolik')->count(),
                'mhs_hindu' => User::where('role', 'mahasiswa')->where('agama', 'hindu')->count(),
                'mhs_budha' => User::where('role', 'mahasiswa')->where('agama', 'budha')->count(),
                'mhs_konghucu' => User::where('role', 'mahasiswa')->where('agama', 'konghucu')->count(),
                'pengumuman' => Pengumuman::where('role', 'non-mahasiswa')->get(),
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
