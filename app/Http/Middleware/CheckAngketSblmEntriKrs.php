<?php

namespace App\Http\Middleware;

use App\Models\Angket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAngketSblmEntriKrs
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $angketIds = Angket::where('kondisi', 'sebelum_entri_krs')->pluck('id');
            $userAngkets = Auth::user()->hasilAngket;

            if (Auth::user()->role == 'mahasiswa' && $angketIds->count() > 0 && $userAngkets->whereIn('angket_id', $angketIds)->count() != Angket::where('kondisi', 'sebelum_entri_krs')->count()) {
                return redirect()->route('test.index', ['kondisi' => 'sebelum_entri_krs'])->with('toast_warning', 'Isi Angket, Anda perlu mengisi angket terlebih dahulu!');
            }
        }

        return $next($request);
    }
}
