<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $jadwal = Jadwal::find($request->jadwal_id);
        $pertemuan = Pertemuan::where('user_id', auth()->user()->id)->where('jadwal_id', $jadwal->id)->count();
        $nama = 'Pertemuan '.($pertemuan + 1);

        return view('pertemuan.create', ['jadwal' => $jadwal, 'nama' => $nama]);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'jadwal_id' => 'required',
            'topic' => 'nullable',
            'sub_topic' => 'nullable',
            'dosen_pengganti' => 'nullable',
        ]);

        $data['user_id'] = auth()->user()->id;

        $pertemuan = Pertemuan::create($data);

        return redirect(route('pertemuan.show', $pertemuan->id))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function show(Pertemuan $pertemuan)
    {
        $records = $pertemuan->jadwal->kelas->users->map(function ($user) use ($pertemuan) {
            $presensi = $pertemuan->presensi->where('user_id', $user->id)->first();

            return [
                'nomor' => $user->nomor,
                'name' => $user->name,
                'created_at' => optional($presensi)->created_at,
                'id' => optional($presensi)->id,
            ];
        });

        return view('pertemuan.show', [
            'pertemuan' => $pertemuan,
            'records' => $records,
        ]);
    }

    public function edit(Pertemuan $pertemuan)
    {
        //
    }

    public function update(Request $request, Pertemuan $pertemuan)
    {
        //
    }

    public function destroy(Pertemuan $pertemuan)
    {
        //
    }
}
