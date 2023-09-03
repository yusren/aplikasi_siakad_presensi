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
    public function index()
    {
        return view('krs.index', [
            'users' => User::where('role', 'mahasiswa')->whereHas('krs')->get(),
        ]);
    }

    public function create()
    {
        return view('krs.create', [
            'kelas' => Kelas::get(),
            'prodi' => Prodi::get(),
            'matakuliah' => Matakuliah::get(),
            'tahunAjaran' => TahunAjaran::get(),
        ]);
    }

    public function store(Request $request)
    {
        $prodi = Prodi::findOrFail($request->prodi_id);

        foreach ($prodi->kelas as $kelas) {
            foreach ($kelas->users as $user) {
                foreach ($request->matakuliah as $mk) {
                    Krs::create([
                        'user_id' => $user->id,
                        'matakuliah_id' => $mk,
                        'tahun_ajaran_id' => $request->tahun_ajaran_id,
                    ]);
                }
            }
        }
    }

    public function show(Krs $kr)
    {
        return view('krs.show', compact('krs'));
    }

    public function edit(Krs $krs)
    {
        //
    }

    public function update(Request $request, Krs $krs)
    {
        //
    }

    public function destroy(Krs $krs)
    {
        //
    }
}
