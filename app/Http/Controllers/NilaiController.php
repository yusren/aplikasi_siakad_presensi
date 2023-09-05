<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranId = $request->input('tahun_ajaran_id', TahunAjaran::where('is_active', true)->latest()->first()->id);
        $matakuliahId = $request->input('matakuliah_id', Matakuliah::where('user_id', auth()->id())->first()->id);
        $tahunAjaranAktif = TahunAjaran::find($tahunAjaranId);
        $matakuliahAktif = Matakuliah::find($matakuliahId);
        $users = User::with(['krs' => function ($query) use ($tahunAjaranId, $matakuliahId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId)
                ->where('matakuliah_id', $matakuliahId);
        }])->whereHas('krs', function ($query) use ($tahunAjaranId, $matakuliahId) {
            $query->where('tahun_ajaran_id', $tahunAjaranId)
                ->where('matakuliah_id', $matakuliahId);
        })->get();

        return view('input.index', [
            'users' => $users,
            'matakuliah' => Matakuliah::where('user_id', auth()->id())->get(),
            'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            'matakuliahAktif' => $matakuliahAktif,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ]);
    }

    public function store(Request $request)
    {
        $krsIds = $request->input('krs_id');
        $nilaiTugas = $request->input('nilai_tugas');
        $nilaiUts = $request->input('nilai_uts');
        $nilaiUas = $request->input('nilai_uas');
        $nilaiKeaktifan = $request->input('nilai_keaktifan');
        foreach ($krsIds as $index => $krsId) {
            $krs = Krs::findOrFail($krsId);
            if ($krs) {
                $krs->update([
                    'nilai_tugas' => $nilaiTugas[$index],
                    'nilai_uts' => $nilaiUts[$index],
                    'nilai_uas' => $nilaiUas[$index],
                    'nilai_keaktifan' => $nilaiKeaktifan[$index],
                ]);
            }
        }

        return redirect()->route('nilai.index')->with('success', 'Data updated successfully');
    }
}
