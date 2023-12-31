<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required',
            // 'user_id' => 'required',
            'prodi_id' => 'required',
            'angkatan' => 'required',
            'mahasiswa' => 'required',
        ];
    }
}
