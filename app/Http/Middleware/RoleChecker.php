<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Memastikan pengguna sudah login dan peran mereka sesuai
        if (Auth::check() && Auth::user()->id_role == $role) {
            return $next($request);
        }

        // Jika pengguna tidak sesuai, arahkan ke halaman lain (misalnya halaman akses ditolak)
        return redirect()->route('access-denied')->with('error', 'Anda tidak memiliki akses.');
    }
}
