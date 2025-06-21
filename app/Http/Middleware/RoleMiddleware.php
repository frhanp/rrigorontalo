<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    // Cek jika user tidak login atau rolenya tidak ada di dalam daftar $roles yang diizinkan
    if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
        // Redirect atau berikan response 'unauthorized'
        abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
    }
    return $next($request);
}

}
