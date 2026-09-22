<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Illuminate\Http\Request;

class TrabajoController extends Controller
{
    /**
     * Mostrar listado de trabajos.
     */
    public function index()
    {
        
    }

    /**
     * Mostrar formulario para crear un trabajo.
     */
    public function create()
    {
        return view('admin.trabajos.create');
    }

    /**
     * Guardar un nuevo trabajo.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Mostrar un trabajo.
     */
    public function show(Trabajo $trabajo)
    {
        return view('web.trabajos.show', compact('trabajo'));
    }

    /**
     * Mostrar formulario para editar.
     */
    public function edit(Trabajo $trabajo)
    {
        return view('admin.trabajos.edit', compact('trabajo'));
    }

    /**
     * Actualizar un trabajo.
     */
    public function update(Request $request, Trabajo $trabajo)
    {
        //
    }

    /**
     * Eliminar un trabajo.
     */
    public function destroy(Trabajo $trabajo)
    {
        //
    }
}
