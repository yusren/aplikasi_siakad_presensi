<?php

namespace App\Http\Middleware;

use App\Models\Angket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAngket
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $angketIds = Angket::where('kondisi', 'setelah_login')->pluck('id');
            $userAngkets = Auth::user()->hasilAngket;

            if (Auth::user()->role != 'superadmin' && Auth::user()->role != 'admin' && $userAngkets->whereIn('angket_id', $angketIds)->count() != Angket::where('kondisi', 'setelah_login')->count()) {
                return redirect()->route('test.index')->with('toast_warning', 'Isi Angket, Anda perlu mengisi angket terlebih dahulu!');
            }
        }

        return $next($request);
    }
}
