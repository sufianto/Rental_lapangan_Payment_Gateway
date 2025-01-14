<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role != $role) {
            // Jika role tidak cocok, arahkan pengguna ke halaman lain
            return redirect()->route('backend.login');
        }

        return $next($request);
    }
}
