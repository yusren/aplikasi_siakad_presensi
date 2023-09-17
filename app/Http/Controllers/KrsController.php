<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use App\Services\NilaiService;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    protected $nilaiService;

    public function __construct(NilaiService $nilaiService)
    {
        $this->nilaiService = $nilaiService;
    }

    public function getUsersByRoleAndTahunAjaran($role, $tahunAjaranId)
    {
        return User::where('role', $role)
            ->whereHas('krs', function ($query) use ($tahunAjaranId) {
                $query->where('tahun_ajaran_id', $tahunAjaranId);
            })
            ->with(['krs' => function ($query) use ($tahunAjaranId) {
                $query->where('tahun_ajaran_id', $tahunAjaranId);
            }])
            ->get();
    }

    public function index(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId);

        if (auth()->user()->role == 'mahasiswa') {
            $taUser = auth()->user()->krs->pluck('tahun_ajaran_id');

            return view('krs.user.index', [
                'users' => auth()->user(),
                'krs' => auth()->user()->krs->where('tahun_ajaran_id', $tahunAjaranId),
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::whereIn('id', $taUser)->orderBy('name')->get(),
            ]);
        } else {
            return view('krs.index', [
                'users' => $users,
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        }
    }

    public function indexDetailprodi(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId)
            ->groupBy(function ($item, $key) {
                return $item->kelas->first()->prodi->name;
            });

        if (auth()->user()->role == 'mahasiswa') {
            return view('krs.user.index', [
                'users' => auth()->user(),
                'krs' => auth()->user()->krs->where('tahun_ajaran_id', $tahunAjaranId)->where('status', 'menunggu'),
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        } else {
            return view('krs.detail.prodi.index', [
                'users' => $users,
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        }
    }

    public function indexDetailkelas(Request $request)
    {
        $prodi = $request->prodi;
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId)
            ->filter(function ($item) use ($prodi) {
                return $item->kelas->first()->prodi->id == $prodi;
            })
            ->groupBy(function ($item, $key) {
                return $item->kelas->first()->name;
            });

        return view('krs.detail.kelas.index', [
            'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
            'users' => $users,
        ]);
    }

    public function indexDetailmahasiswa(Request $request)
    {
        $kelas = $request->kelas;
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $users = $this->getUsersByRoleAndTahunAjaran('mahasiswa', $tahunAjaranId)
            ->filter(function ($item) use ($kelas) {
                return $item->kelas->first()->id == $kelas;
            });

        return view('krs.detail.mahasiswa.index', [
            'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('krs.create', [
            'kelas' => Kelas::get(),
            'prodi' => Prodi::get(),
            'matakuliah' => Matakuliah::get(),
            'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // $prodi = Prodi::findOrFail($request->prodi_id);
        $kelas = Kelas::findOrFail($request->kelas_id);

        // foreach ($prodi->kelas as $kelas) {
        foreach ($kelas->users as $user) {
            foreach ($request->matakuliah as $mk) {
                Krs::create([
                    'user_id' => $user->id,
                    'matakuliah_id' => $mk,
                    'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    'semester' => $request->semester,
                ]);
            }
        }
        // }

        return redirect(route('krs.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Krs $kr)
    {
        return view('krs.show', compact('krs'));
    }

    public function pengajuanKrs(Request $request)
    {
        $krsCollection = auth()->user()->krs->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        foreach ($krsCollection as $krs) {
            $krs->update(['status' => 'ajukan']);
        }

        // return redirect(route('krs.index'))->with('toast_success', 'Krs Berhasil Di Ajukan!');
        return redirect()->back()->with('toast_success', 'Krs Berhasil Di Ajukan!');
    }

    public function rekap(Request $request)
    {
        $bobot = $this->nilaiService->getBobot();

        return view('krs.rekap', [
            'krs' => auth()->user()->krs->sortBy('tahunAjaran'),
            'bobot_tugas' => $bobot['bobot_tugas'],
            'bobot_uts' => $bobot['bobot_uts'],
            'bobot_uas' => $bobot['bobot_uas'],
            'bobot_keaktifan' => $bobot['bobot_keaktifan'],
        ]);
    }

    public function approveByDosbingKrs(Request $request)
    {
        $krs = Krs::where('status', 'setujui_by_keuangan')
            ->whereHas('user', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get()
            ->groupBy(['user_id', 'tahun_ajaran_id']);

        return view('krs.approveByDosbingKrs', ['krs' => $krs]);
    }

    public function approveByKaprodiKrs(Request $request)
    {
        $krs = Krs::where('status', 'setujui_by_dosbing')->get()
            ->groupBy(['user_id', 'tahun_ajaran_id']);

        return view('krs.approveBykaprodiKrs', [
            'krs' => $krs,
        ]);
    }

    public function approveByKeuanganKrs(Request $request)
    {
        $krs = Krs::where('status', 'ajukan')->get()
            ->groupBy(['user_id', 'tahun_ajaran_id']);

        return view('krs.approveBykeuanganKrs', [
            'krs' => $krs,
        ]);
    }

    public function approveByDosbingStoreKrs(Request $request)
    {
        foreach ($request->selectedUserTahunAjaranID as $userTahunAjaran) {
            [$userId, $tahunAjaranId] = explode('_', $userTahunAjaran);

            Krs::where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->update(['status' => 'setujui_by_dosbing']);
        }

        // return $this->approveBy($request, 'dosbing', 'Dosbing');
        return redirect(route('krs.approveByDosbing'))->with('toast_success', 'Krs Berhasil Di Approve Dosbing!');
    }

    public function approveByKaprodiStoreKrs(Request $request)
    {
        foreach ($request->selectedUserTahunAjaranID as $userTahunAjaran) {
            [$userId, $tahunAjaranId] = explode('_', $userTahunAjaran);

            Krs::where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->update(['status' => 'setujui_by_kaprodi']);
        }

        // return $this->approveBy($request, 'kaprodi', 'Kaprodi');
        return redirect(route('krs.approveByKaprodi'))->with('toast_success', 'Krs Berhasil Di Approve Kaprodi!');
    }

    public function approveByKeuanganStoreKrs(Request $request)
    {
        foreach ($request->selectedUserTahunAjaranID as $userTahunAjaran) {
            [$userId, $tahunAjaranId] = explode('_', $userTahunAjaran);

            Krs::where('user_id', $userId)
                ->where('tahun_ajaran_id', $tahunAjaranId)
                ->update(['status' => 'setujui_by_keuangan']);
        }

        // return $this->approveBy($request, 'keuangan', 'Keuangan');
        return redirect(route('krs.approveByKeuangan'))->with('toast_success', 'Krs Berhasil Di Approve Keuangan!');
    }

    // private function approveBy(Request $request, $status, $role)
    // {
    //     Krs::whereIn('id', $request->selectedKrsID)->update(['status' => 'setujui_by_'.$status]);

    //     return redirect(route('krs.approveBy'.$role))->with('toast_success', 'Krs Berhasil Di Approve '.$role.'!');
    // }

    public function khs(Request $request)
    {
        $tahunAjaranId = $request->tahun_ajaran_id ?: TahunAjaran::where('is_active', true)->latest()->first()->id;
        $krs = auth()->user()->krs->where('tahun_ajaran_id', $tahunAjaranId);
        $bobot = $this->nilaiService->getBobot();
        $totalScore = $this->nilaiService->calculateScore($krs, $bobot);
        $totalSks = $this->nilaiService->getTotalSksAllSemesters($krs);

        $ip = $totalScore / $totalSks;
        $ipk = $this->nilaiService->getTotalScoreAllSemesters($krs) / $this->nilaiService->getTotalSksAllSemesters($krs);

        $taUser = auth()->user()->krs->pluck('tahun_ajaran_id');

        return view('krs.khs', [
            'totalScore' => $totalScore,
            'bobot_tugas' => $bobot['bobot_tugas'],
            'bobot_uts' => $bobot['bobot_uts'],
            'bobot_uas' => $bobot['bobot_uas'],
            'bobot_keaktifan' => $bobot['bobot_keaktifan'],
            'krs' => $krs,
            'tahunAjaran' => TahunAjaran::whereIn('id', $taUser)->orderBy('name')->get(),
            'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
            'ip' => number_format($ip, 2),
            'ipk' => number_format($ipk, 2),
        ]);
    }
}
