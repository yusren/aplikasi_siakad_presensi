<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengumumanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cover' => 'nullable|mimes:png,jpg|max:2048',
            'judul' => 'required',
            'description' => 'required',
            'role' => 'nullable',
            'users' => 'nullable',
            'kelas' => 'nullable',
            'prodi' => 'nullable',
        ];
    }
}
