<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Jika pengguna tidak login, redirect ke halaman login
            return redirect('/login')->with('message', 'Anda harus login untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
