<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsAdministrador
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $tipo = strtolower((string) (auth()->user()->tipoUsuario?->nombre ?? ''));

        if ($tipo !== 'administrador') {
            abort(403);
        }

        return $next($request);
    }
}
