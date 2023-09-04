<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required',
            'fakultas_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'jenjang' => 'required',
        ];
    }
}
