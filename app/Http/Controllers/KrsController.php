<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjaranId = $request->input('tahun_ajaran_id', TahunAjaran::where('is_active', true)->latest()->first()->id);
        $users = User::where('role', 'mahasiswa')
            ->whereHas('krs', function ($query) use ($tahunAjaranId) {
                $query->where('tahun_ajaran_id', $tahunAjaranId);
            })
            ->with(['krs' => function ($query) use ($tahunAjaranId) {
                $query->where('tahun_ajaran_id', $tahunAjaranId);
            }])
            ->get();

        if (auth()->user()->role == 'mahasiswa') {
            return view('krs.user.index', [
                'users' => auth()->user(),
                'krs' => auth()->user()->krs->where('tahun_ajaran_id', $tahunAjaranId),
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        } else {
            return view('krs.index', [
                'users' => $users,
                'tahunAjaranAktif' => TahunAjaran::find($tahunAjaranId),
                'tahunAjaran' => TahunAjaran::orderBy('name')->get(),
            ]);
        }
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

    // public function edit(Krs $kr)
    // {
    //     //
    // }

    // public function update(Request $request, Krs $kr)
    // {
    //     //
    // }

    public function destroy(Krs $krs)
    {
        //
    }
}
