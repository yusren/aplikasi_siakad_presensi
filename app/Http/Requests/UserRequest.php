<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'prodi_id' => 'required',
            'user_id' => 'nullable',
            'name' => 'required',
            'nomor' => 'required_if:role,mahasiswa',
            'photo' => 'nullable',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'no_telp' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => 'same:confirm-password',
            'agama' => 'required',
            'alamat' => 'nullable',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
        ];

        if ($this->role == 'dosen') {
            $rules = array_merge($rules, [
                'gelar_akademik' => 'required',
                'jabatan_akademik' => 'required',
                'pendidikan_tinggi' => 'required',
                'status_ikatan_kerja' => 'required',
            ]);
        }

        return $rules;
    }
}
