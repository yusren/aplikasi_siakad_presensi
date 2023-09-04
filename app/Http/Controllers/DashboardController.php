<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'mahasiswa') {
            return view('dashboard.user.index', []);
        } else {
            return view('dashboard.index', [
                'users' => User::count(),
            ]);
        }
    }
}
