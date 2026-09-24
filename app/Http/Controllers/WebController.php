<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Localidad;
use App\Models\Trabajo;

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
            'organizacion',
        ])
            ->where('activo', true)
            ->orderByDesc('fecha_publicacion')
            ->limit(6)
            ->get();

        $localidades = Localidad::orderBy('nombre', 'asc')->get();

        return view('web.index', compact('categorias', 'trabajos', 'localidades'));
    }
}
