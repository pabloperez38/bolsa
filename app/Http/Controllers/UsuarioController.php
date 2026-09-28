<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Trabajo;
use Illuminate\Support\Facades\Auth;
use App\Models\Postulacion;

class UsuarioController extends Controller
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

        $usuario = Auth::user();

        return view('usuario.index', compact('usuario', 'categorias'));
    }

    public function perfil()
    {
        $usuario = Auth::user();

        return view('usuario.perfil.index', compact('usuario'));
    }

    public function trabajos()
    {
        $usuario = Auth::user();

        // Los estudiantes no pueden acceder a trabajos
        if ($usuario->tipoUsuario->nombre === 'estudiante') {
            abort(403);
        }

        $trabajos = Trabajo::with([
            'categoria',
            'subcategoria',
            'empresa',
            'tipoOferta',
            'modalidad',
            'tipoContratacion',
        ])
            ->where('tipo_oferta_id', 1)
            ->where('activo', true)
            ->orderByDesc('fecha_publicacion')
            ->paginate(10);

        return view(
            'usuario.trabajos.index',
            compact('usuario', 'trabajos')
        );
    }

    public function pasantias()
    {
        $usuario = Auth::user();

        // Solo los estudiantes pueden acceder a pasantías
        if ($usuario->tipoUsuario->nombre !== 'estudiante') {
            abort(403);
        }

        $trabajos = Trabajo::with([
            'categoria',
            'subcategoria',
            'empresa',
            'tipoOferta',
            'modalidad',
            'tipoContratacion',
        ])
            ->where('tipo_oferta_id', 2)
            ->where('activo', true)
            ->orderByDesc('fecha_publicacion')
            ->paginate(10);

        return view(
            'usuario.trabajos.index',
            compact('usuario', 'trabajos')
        );
    }

    public function postulaciones()
    {
        $usuario = Auth::user();

        return view('usuario.postulaciones.index', compact('usuario'));
    }

    public function postularse($id)
    {
        $usuario = Auth::user();

        // Solo estudiantes, graduados y docentes
        $tipoUsuario = $usuario->tipoUsuario?->nombre;

        if (!in_array($tipoUsuario, ['estudiante', 'graduado', 'docente'])) {
            abort(403);
        }

        // El perfil debe estar completo
        if (!$usuario->perfil || !$usuario->perfil->estaCompleto()) {
            return redirect()
                ->route('usuario.perfil')
                ->with(
                    'warning',
                    'Debés completar tu perfil antes de postularte a una oferta.'
                );
        }

        // Buscar la oferta
        $trabajo = Trabajo::findOrFail($id);

        // La oferta debe estar activa
        if (!$trabajo->activo) {
            abort(404);
        }

        // La oferta no debe estar vencida
        if (
            $trabajo->fecha_cierre &&
            $trabajo->fecha_cierre->isPast()
        ) {
            return back()->with(
                'warning',
                'Esta oferta ya no se encuentra disponible para postularse.'
            );
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

        // Verificar si ya existe una postulación
        $yaPostulado = Postulacion::where('user_id', $usuario->id)
            ->where('trabajo_id', $trabajo->id)
            ->exists();

        if ($yaPostulado) {
            return back()->with(
                'warning',
                'Ya te postulaste a esta oferta.'
            );
        }

        // Crear la postulación
        Postulacion::create([
            'user_id' => $usuario->id,
            'trabajo_id' => $trabajo->id,
            'estado' => 'pendiente',
            'fecha_postulacion' => now(),
        ]);

        return back()->with(
            'success',
            'Tu postulación fue registrada correctamente.'
        );
    }
}
