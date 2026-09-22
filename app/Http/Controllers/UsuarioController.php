<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
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
}
