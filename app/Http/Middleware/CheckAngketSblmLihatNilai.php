<?php

namespace App\Http\Middleware;

use App\Models\Angket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAngketSblmLihatNilai
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $angketIds = Angket::where('kondisi', 'sebelum_lihat_nilai')->pluck('id');
            $userAngkets = Auth::user()->hasilAngket;

            if (Auth::user()->role == 'mahasiswa' && $angketIds->count() > 0 && $userAngkets->whereIn('angket_id', $angketIds)->count() != Angket::where('kondisi', 'sebelum_lihat_nilai')->count()) {
                return redirect()->route('test.index', ['kondisi' => 'sebelum_lihat_nilai'])->with('toast_warning', 'Isi Angket, Anda perlu mengisi angket terlebih dahulu!');
            }
        }

        return $next($request);
    }
}
