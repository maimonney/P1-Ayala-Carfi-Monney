<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y si es administrador
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            \Log::warning('Acceso denegado para el usuario: ' . (Auth::user()->email ?? 'Usuario no autenticado'));
            return redirect('/')->with('error', 'Acceso denegado');
        }

        return $next($request);
    }
}
