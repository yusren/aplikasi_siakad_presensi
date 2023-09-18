<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.mahasiswa.login', []);
    }
}
