<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function categorias()
    {
        $usuario = Auth::user();

        $categorias = Categoria::with([
            'subcategorias' => function ($query) {
                $query->where('activo', true)
                    ->orderBy('nombre');
            }
        ])
            ->where('activo', true)
            ->orderBy('nombre')
            ->paginate(10);

        return view('admin.categorias.index', compact('usuario', 'categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function storeCategoria(Request $request)
    {
        // Validar los datos recibidos
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'unique:categorias,nombre',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.string' => 'El nombre de la categoría debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',
            'nombre.unique' => 'Ya existe una categoría con ese nombre.',

            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.max' => 'La descripción no puede superar los 1000 caracteres.',
        ]);

        // Crear la categoría
        Categoria::create($datos);

        // Volver al listado
        return redirect()
            ->route('admin.categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    public function editCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('admin.categorias.edit', compact('categoria'));
    }

    public function updateCategoria(Request $request, $id)
    {
        // Buscar la categoría
        $categoria = Categoria::findOrFail($id);

        // Validación
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'unique:categorias,nombre,' . $categoria->id,
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',

            'nombre.unique' => 'Ya existe otra categoría con ese nombre.',

            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',

            'descripcion.max' => 'La descripción no puede superar los 1000 caracteres.',
        ]);

        // Actualizar
        $categoria->update($datos);

        // Volver al listado
        return redirect()
            ->route('admin.categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }
}
