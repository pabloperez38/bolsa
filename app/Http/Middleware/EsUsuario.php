<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsUsuario
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $tipo = auth()->user()->tipoUsuario->nombre;

        if (!in_array($tipo, [
            'estudiante',
            'graduado',
            'personal',
        ])) {
            abort(403);
        }

        return $next($request);
    }
}
