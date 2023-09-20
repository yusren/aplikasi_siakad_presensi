<?php

namespace App\Imports;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    public function model(array $row)
    {
        $prodi = Prodi::where('code', $row[0])->first();
        $user = User::where('role', '!=', 'mahasiswa')->where('name', $row[1])->first();

        if (! $prodi || ! $user) {
            return dd('tidak ada prodi/dosen pa-nya');
        }

        return new User([
            'user_id' => $user->id,
            'prodi_id' => $prodi->id,
            'nomor' => $row[2],
            'name' => $row[3],
            'username' => $row[3],
            'role' => 'mahasiswa',
            'email' => $row[4],
            'password' => Hash::make($row[5]),
            'alamat' => $row[6],
            'no_telp' => $row[7],
            'tempat_lahir' => $row[8],
            'tanggal_lahir' => $row[9],
            'jenis_kelamin' => $row[10],
            'agama' => $row[11],
            // 'gelar_akademik' => null,
            // 'jabatan_akademik' => null,
            // 'pendidikan_tinggi' => null,
            // 'status_ikatan_kerja' => null,
        ]);
    }
}
