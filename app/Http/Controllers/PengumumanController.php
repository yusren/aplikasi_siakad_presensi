<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengumumanRequest;
use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\Prodi;
use App\Models\User;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('pengumuman.index', [
            'pengumuman' => Pengumuman::get(),
        ]);
    }

    public function create()
    {
        return view('pengumuman.create', [
            'users' => User::orderBy('role')->get(),
            'kelas' => Kelas::get(),
            'prodi' => Prodi::get(),
            'roles' => [
                'superadmin',
                'admin',
                'lpm',
                'kaprodi',
                'birokeuangan',
                'akademik',
                'keuangan_sdm',
                'kemahasiswaan',
                'mahasiswa',
                'dosen',
                'karyawan',
            ],
        ]);
    }

    public function store(PengumumanRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time().'.'.$cover->getClientOriginalExtension();
            $cover->storeAs('public/covers', $coverName);
            $coverPath = 'storage/covers/'.$coverName;
            $data['cover'] = $coverPath;
        }

        $data['role'] = isset($data['role']) ? json_encode($data['role']) : null;
        $data['users'] = isset($data['users']) ? json_encode($data['users']) : null;
        $data['kelas'] = isset($data['kelas']) ? json_encode($data['kelas']) : null;
        $data['prodi'] = isset($data['prodi']) ? json_encode($data['prodi']) : null;

        Pengumuman::create($data);

        return redirect(route('pengumuman.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Pengumuman $pengumuman)
    {
        dd($pengumuman->toArray());
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', [
            'pengumuman' => $pengumuman,
            'users' => User::orderBy('role')->get(),
            'kelas' => Kelas::get(),
            'prodi' => Prodi::get(),
            'roles' => [
                'superadmin',
                'admin',
                'lpm',
                'kaprodi',
                'birokeuangan',
                'akademik',
                'keuangan_sdm',
                'kemahasiswaan',
                'mahasiswa',
                'dosen',
                'karyawan',
            ],
            'prole' => json_decode($pengumuman->role, true),
            'pusers' => json_decode($pengumuman->users, true),
            'pkelas' => json_decode($pengumuman->kelas, true),
            'pprodi' => json_decode($pengumuman->prodi, true),
        ]);
    }

    public function update(PengumumanRequest $request, Pengumuman $pengumuman)
    {
        $data = $request->validated();
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time().'.'.$cover->getClientOriginalExtension();
            $cover->storeAs('public/covers', $coverName);
            $coverPath = 'storage/covers/'.$coverName;
            $data['cover'] = $coverPath;
        }
        $pengumuman->update($data);

        return redirect(route('pengumuman.index'))->with('toast_success', 'Berhasil Mengubah Data!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect(route('pengumuman.index'))->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
