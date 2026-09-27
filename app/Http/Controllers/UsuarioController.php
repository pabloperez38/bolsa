<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Trabajo;
use Illuminate\Support\Facades\Auth;

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
}
