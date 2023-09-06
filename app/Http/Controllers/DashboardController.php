<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function setting()
    {
        return view('dashboard.setting', [
            'baak' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak'],
            'keuangan' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'],
            'baak_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak_nomor'],
            'keuangan_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_nomor'],
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'baak' => 'required',
            'keuangan' => 'required',
            'baak_nomor' => 'required',
            'keuangan_nomor' => 'required',
        ]);

        Storage::disk('public')->put('settings.json', json_encode([
            'baak' => $request->baak,
            'keuangan' => $request->keuangan,
            'baak_nomor' => $request->baak_nomor,
            'keuangan_nomor' => $request->keuangan_nomor,
        ]));

        return redirect(route('setting'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }
}
