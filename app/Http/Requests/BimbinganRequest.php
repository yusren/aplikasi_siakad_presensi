<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BimbinganRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'user_id' => 'nullable',
            'tahun_ajaran_id' => 'required',
        ];
    }
}
