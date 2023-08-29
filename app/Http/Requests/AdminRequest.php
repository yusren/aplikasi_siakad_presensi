<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'status' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:confirm-password',
        ];
    }
}
