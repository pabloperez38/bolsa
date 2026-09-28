<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarPerfilCompleto
{
    public function handle(Request $request, Closure $next): Response
    {
        $usuario = $request->user();

        if (!$usuario) {
            return $next($request);
        }

        $tiposConPerfil = [
            'estudiante',
            'graduado',
            'docente',
        ];

        $tipoUsuario = strtolower((string) ($usuario->tipoUsuario?->nombre ?? ''));

        if (!in_array($tipoUsuario, $tiposConPerfil, true)) {
            return $next($request);
        }

        if (!$usuario->perfil || !$usuario->perfil->estaCompleto()) {
            return redirect()
                ->route('usuario.perfil')
                ->with('warning', 'Falta completar tu perfil.');
        }

        return $next($request);
    }
}
