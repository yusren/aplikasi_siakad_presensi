<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tahun_ajaran_id' => 'required|integer',
            'user_id' => 'required|integer',
            'ruang_id' => 'required|integer',
            'prodi_id' => 'required|integer',
            'matakuliah_id' => 'required|integer',
            'kelas_id' => 'required|integer',
            'jam' => 'required|date_format:H:i',
            'hari' => 'required|string',
        ];
    }
}
