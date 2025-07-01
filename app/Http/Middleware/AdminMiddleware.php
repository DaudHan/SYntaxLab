<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login DAN perannya adalah 'ADMIN'
        if (Auth::check() && Auth::user()->role === 'ADMIN') {
            // Jika ya, izinkan permintaan untuk melanjutkan.
            return $next($request);
        }

        // Jika tidak, tolak akses.
        abort(403, 'AKSES DITOLAK');
    }
}