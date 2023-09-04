<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatakuliahRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required',
            'prodi_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'sks' => 'required',
            'semester' => 'required',
            'kategori' => 'required',
        ];
    }
}
