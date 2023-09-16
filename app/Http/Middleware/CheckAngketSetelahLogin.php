<?php

namespace App\Http\Middleware;

use App\Models\Angket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAngketSetelahLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $angketIds = Angket::where('kondisi', 'setelah_login')->pluck('id');
            $userAngkets = Auth::user()->hasilAngket;

            if (! in_array(Auth::user()->role, ['superadmin', 'admin', 'lpm', 'kaprodi', 'birokeuangan']) && $angketIds->count() > 0 && $userAngkets->whereIn('angket_id', $angketIds)->count() != Angket::where('kondisi', 'setelah_login')->count()) {
                return redirect()->route('test.index', ['kondisi' => 'setelah_login'])->with('toast_warning', 'Isi Angket, Anda perlu mengisi angket terlebih dahulu!');
            }
        }

        return $next($request);
    }
}
