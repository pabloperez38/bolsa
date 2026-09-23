<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizacionController extends Controller
{
    public function dashboard()
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
            ->get();

        return view('organizacion.index', compact('usuario', 'categorias'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();

        $organizaciones = Organizacion::orderBy('nombre')->get();


        return view('admin.organizaciones.index', compact('usuario', 'organizaciones'));
    }

    public function usuarios()
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
            ->get();

        return view('admin.usuarios.index', compact('usuario', 'categorias'));
    }

    public function ofertasLaborales()
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
            ->get();

        return view('admin.ofertas-laborales.index', compact('usuario', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizacion $organizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizacion $organizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organizacion $organizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizacion $organizacion)
    {
        //
    }
}
