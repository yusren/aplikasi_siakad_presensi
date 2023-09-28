<?php

namespace App\Imports;

use App\Models\Alamat;
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

        $mahasiswa = User::create([
            'user_id' => $user->id,
            'prodi_id' => $prodi->id,
            'nomor' => $row[2],
            'name' => $row[3],
            'username' => $row[3],
            'role' => 'mahasiswa',
            'email' => $row[4],
            'password' => Hash::make($row[2]),
            'alamat' => $row[5],
            'no_telp' => $row[6],
            'tempat_lahir' => $row[7],
            'tanggal_lahir' => $row[8],
            'jenis_kelamin' => $row[9],
            'agama' => $row[10],
            // 'gelar_akademik' => null,
            // 'jabatan_akademik' => null,
            // 'pendidikan_tinggi' => null,
            // 'status_ikatan_kerja' => null,
        ]);

        $provinceName = $row[11] ? strtoupper($row[11]) : null;
        $cityName = $row[12] ? strtoupper($row[12]) : null;
        $districtName = $row[13] ? strtoupper($row[13]) : null;
        $villageName = $row[14] ? strtoupper($row[14]) : null;

        $province = $provinceName ? \Indonesia::allProvinces()->where('name', $provinceName)->first() : null;
        $city = $cityName ? \Indonesia::allCities()->where('name', $cityName)->where('province_code', $province ? $province->code : null)->first() : null;
        $district = $districtName ? \Indonesia::allDistricts()->where('name', $districtName)->where('city_code', $city ? $city->code : null)->first() : null;
        $village = $villageName ? \Indonesia::allVillages()->where('name', $villageName)->where('district_code', $district ? $district->code : null)->first() : null;

        if ($province && $city && $district && $village) {
            Alamat::create([
                'user_id' => $mahasiswa->id,
                'provinsi' => $province->id,
                'kota' => $city->id,
                'kecamatan' => $district->id,
                'desa' => $village->id,
            ]);
        }
    }
}
