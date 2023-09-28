<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Split the roles by the | character
        $roles = collect($roles)->flatMap(function ($role) {
            return explode('|', $role);
        })->toArray();

        if (! in_array($user->role, $roles)) {
            return redirect('dashboard')->with('toast_error', 'Maaf Anda tidak punya akses');
        }

        return $next($request);
    }
}
