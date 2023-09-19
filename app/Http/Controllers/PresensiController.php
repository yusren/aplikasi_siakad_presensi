<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pertemuan_id' => 'required',
            'nim' => 'required',
        ]);
        $mahasiswa = User::where('role', 'mahasiswa')->where('nomor', $request->nim)->first();
        $pertemuan = Pertemuan::find($request->pertemuan_id);
        $presensi = Presensi::where('pertemuan_id', $pertemuan->id)->where('user_id', $mahasiswa->id)->first();
        if (isset($presensi)) {
            return redirect()->back()->with('toast_error', 'Sudah Absen!');
        }
        $kelas = $pertemuan->jadwal->kelas;

        if ($mahasiswa->kelas->first()->id != $kelas->id) {
            return redirect()->back()->with('toast_error', 'Tidak Termasuk Dalam Kelas/Jadwal!');
        }

        Presensi::create([
            'user_id' => $mahasiswa->id,
            'pertemuan_id' => $request->pertemuan_id,
        ]);

        return redirect()->back()->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function storeBulk(Request $request)
    {
        foreach ($request->selectedNomor as $value) {
            $mahasiswa = User::where('role', 'mahasiswa')->where('nomor', $value)->first();
            Presensi::create([
                'user_id' => $mahasiswa->id,
                'pertemuan_id' => $request->pertemuan_id,
            ]);
        }
    }

    public function show(Presensi $presensi)
    {
        dd($presensi);
    }

    public function edit(Presensi $presensi)
    {
        //
    }

    public function update(Request $request, Presensi $presensi)
    {
        //
    }

    public function destroy(Presensi $presensi)
    {
        $presensi->delete();

        return redirect()->back()->with('toast_error', 'Berhasil Menghapus Data!');
    }
}
