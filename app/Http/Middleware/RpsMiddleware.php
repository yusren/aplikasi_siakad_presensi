<?php

namespace App\Http\Middleware;

use App\Models\Rps;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RpsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $rpsIds = Rps::pluck('id');
            $userRps = Auth::user()->hasilRps;

            if (Auth::user()->role == 'dosen' && $rpsIds->count() > 0 && $userRps->whereIn('rps_id', $rpsIds)->count() != Rps::count()) {
                return redirect()->route('inputrps.index')->with('toast_warning', 'Isi Rps, Anda perlu mengisi rps terlebih dahulu!');
            }
        }

        return $next($request);
    }
}
