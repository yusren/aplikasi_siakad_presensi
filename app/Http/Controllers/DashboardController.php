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
            'baak_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak_nomor'],
            'baak_status' => json_decode(Storage::disk('public')->get('settings.json'), true)['baak_status'],
            'keuangan' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan'],
            'keuangan_nomor' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_nomor'],
            'keuangan_status' => json_decode(Storage::disk('public')->get('settings.json'), true)['keuangan_status'],
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'baak' => 'required',
            'baak_nomor' => 'required',
            'baak_status' => 'required',
            'keuangan' => 'required',
            'keuangan_nomor' => 'required',
            'keuangan_status' => 'required',
        ]);

        Storage::disk('public')->put('settings.json', json_encode([
            'baak' => $request->baak,
            'baak_nomor' => $request->baak_nomor,
            'baak_status' => $request->baak_status,
            'keuangan' => $request->keuangan,
            'keuangan_nomor' => $request->keuangan_nomor,
            'keuangan_status' => $request->keuangan_status,
        ]));

        return redirect(route('setting'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }
}
