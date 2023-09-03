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
            'fakultas_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'jenjang' => 'required',
        ];
    }
}
