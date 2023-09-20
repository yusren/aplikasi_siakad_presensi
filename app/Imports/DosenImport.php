<?php

namespace App\Imports;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class DosenImport implements ToModel
{
    public function model(array $row)
    {
        $prodi = Prodi::where('code', $row[0])->first();
        // $user = User::where('role', '!=', 'mahasiswa')->where('name', $row[1])->first();

        if (! $prodi) {
            return dd('tidak ada prodi');
        }

        return new User([
            // 'user_id' => null,
            'prodi_id' => $prodi->id,
            'nomor' => $row[1],
            'name' => $row[2],
            'username' => $row[3],
            'role' => 'dosen',
            'email' => $row[4],
            'password' => Hash::make($row[5]),
            'alamat' => $row[6],
            'no_telp' => $row[7],
            'tempat_lahir' => $row[8],
            'tanggal_lahir' => $row[9],
            'jenis_kelamin' => $row[10],
            'agama' => $row[11],
            'gelar_akademik' => $row[12],
            'jabatan_akademik' => $row[13],
            'pendidikan_tinggi' => $row[14],
            'status_ikatan_kerja' => $row[15],
        ]);
    }
}
