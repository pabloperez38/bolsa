<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Localidad;
use App\Models\Trabajo;
use App\Models\Postulacion;

class WebController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with([
            'subcategorias' => function ($query) {
                $query->where('activo', true)
                    ->orderBy('nombre');
            }
        ])
            ->where('activo', true)
            ->orderBy('nombre')
            ->get();

        $trabajos = Trabajo::with([
            'categoria',
            'subcategoria',
            'empresa',
        ])
            ->where('activo', true)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $localidades = Localidad::orderBy('nombre', 'asc')->get();

        return view('web.index', compact('categorias', 'trabajos', 'localidades'));
    }

    //Detalle del trabajo o pasantia 

    public function detalle($slug, $id)
    {
        $trabajo = Trabajo::findOrFail($id);

        if (!$trabajo->activo) {
            abort(404);
        }

        // Si no está autenticado, debe iniciar sesión
        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->with(
                    'warning',
                    'Debés iniciar sesión para consultar el detalle de la oferta.'
                );
        }

        $usuario = auth()->user();

        $tipoUsuario = strtolower((string) ($usuario->tipoUsuario?->nombre ?? ''));

        // Administrador y empresa no acceden al detalle como usuario
        if (in_array($tipoUsuario, ['administrador', 'empresa'], true)) {
            abort(403);
        }

        // Estudiante → solamente pasantías
        if (
            $tipoUsuario === 'estudiante' &&
            $trabajo->tipo_oferta_id != 2
        ) {
            abort(403);
        }

        // Graduado y docente → solamente trabajos
        if (
            in_array($tipoUsuario, ['graduado', 'docente']) &&
            $trabajo->tipo_oferta_id != 1
        ) {
            abort(403);
        }

        // Verificar si el usuario tiene una postulación ACTIVA
        // Una postulación retirada no cuenta.
        $yaPostulado = Postulacion::where('user_id', $usuario->id)
            ->where('trabajo_id', $trabajo->id)
            ->where('estado', '!=', 'retirado')
            ->exists();

        // Cargar relaciones
        $trabajo->load([
            'categoria',
            'subcategoria',
            'empresa',
            'tipoOferta',
            'modalidad',
            'tipoContratacion',
        ]);

        return view('web.detalle', compact(
            'trabajo',
            'yaPostulado'
        ));
    }
}
