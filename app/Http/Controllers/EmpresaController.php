<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
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

        return view('empresa.index', compact('usuario', 'categorias'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();

        $empresas = Empresa::orderBy('nombre')->get();


        return view('admin.empresas.index', compact('usuario', 'empresas'));
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

        $ofertas = Trabajo::with([
            'Empresa',
            'categoria',
            'subcategoria',
        ])
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view(
            'admin.ofertas-laborales.index',
            compact('usuario', 'ofertas')
        );
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
    public function show(Empresa $Empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $Empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $Empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $Empresa)
    {
        //
    }
}
