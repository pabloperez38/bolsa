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
        $tipoUsuario = strtolower((string) ($usuario->tipoUsuario?->nombre ?? ''));

        // Los estudiantes no pueden acceder a trabajos
        if ($tipoUsuario === 'estudiante') {
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
        $tipoUsuario = strtolower((string) ($usuario->tipoUsuario?->nombre ?? ''));

        // Solo los estudiantes pueden acceder a pasantías
        if ($tipoUsuario !== 'estudiante') {
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

        $postulaciones = Postulacion::with([
            'trabajo.categoria',
            'trabajo.subcategoria',
            'trabajo.empresa',
            'trabajo.tipoOferta',
            'trabajo.modalidad',
            'trabajo.tipoContratacion',
        ])
            ->where('user_id', $usuario->id)
            ->orderByDesc('fecha_postulacion')
            ->get();

        return view(
            'usuario.postulaciones.index',
            compact('usuario', 'postulaciones')
        );
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

        // Buscar la postulación existente
        $postulacion = Postulacion::where('user_id', $usuario->id)
            ->where('trabajo_id', $trabajo->id)
            ->first();

        // Si existe una postulación y NO está retirada,
        // significa que ya está postulado.
        if ($postulacion && $postulacion->estado !== 'retirado') {
            return back()->with(
                'warning',
                'Ya te postulaste a esta oferta.'
            );
        }

        // Si existe pero está retirada,
        // reutilizamos el registro.
        if ($postulacion && $postulacion->estado === 'retirado') {

            $postulacion->update([
                'estado' => 'pendiente',
                'fecha_postulacion' => now(),
                'observaciones' => null,
            ]);

            return back()->with(
                'success',
                'Tu postulación fue registrada nuevamente.'
            );
        }

        // Si nunca se postuló, crear la postulación.
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

    public function retirarPostulacion($id)
    {
        $usuario = Auth::user();

        $postulacion = Postulacion::where('id', $id)
            ->where('user_id', $usuario->id)
            ->firstOrFail();

        // Solo se puede retirar una postulación que todavía está pendiente
        if (!in_array($postulacion->estado, ['pendiente', 'en_revision'])) {
            return back()->with(
                'warning',
                'Esta postulación ya no puede retirarse.'
            );
        }

        $postulacion->update([
            'estado' => 'retirado',
        ]);

        return back()->with(
            'success',
            'Te retiraste correctamente de la postulación.'
        );
    }
}
