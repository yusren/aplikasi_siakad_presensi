<?php

namespace App\Imports;

use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class MatakuliahImport implements ToModel
{
    public function model(array $row)
    {
        $prodi = Prodi::where('code', $row[0])->first();
        $user = User::where('name', $row[1])->first();

        if (! $prodi || ! $user) {
            return null;
        }

        return new Matakuliah([
            'prodi_id' => $prodi->id,
            'user_id' => $user->id,
            'name' => $row[2],
            'code' => $row[3],
            'sks' => $row[4],
            'semester' => $row[5],
            'kategori' => $row[6],
        ]);
    }
}
