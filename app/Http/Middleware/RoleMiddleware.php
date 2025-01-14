<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role != $role) {
            // Jika role tidak cocok, arahkan pengguna ke halaman lain
            return redirect()->route('backend.beranda');
        }

        return $next($request);
    }
}
