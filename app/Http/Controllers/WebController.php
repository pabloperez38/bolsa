<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Localidad;
use App\Models\Trabajo;
use App\Models\Postulacion;
use App\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use App\Models\Subcategoria;

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

        $provincias = Provincia::with('localidades')
            ->orderBy('nombre', 'asc')
            ->get();;

        return view('web.index', compact(
            'categorias',
            'trabajos',
            'provincias'
        ));
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

        $tipoUsuario = strtolower(
            (string) ($usuario->tipoUsuario?->nombre ?? '')
        );

        // Administrador y empresa no acceden al detalle como usuario
        if (in_array($tipoUsuario, ['administrador', 'empresa'], true)) {
            abort(403);
        }

        // Estudiante → solamente pasantías
        if (
            $tipoUsuario === 'estudiante' &&
            $trabajo->tipo_oferta_id != 2
        ) {
            return redirect()
                ->route('web.ofertas.index')
                ->with(
                    'error',
                    'Esta oferta corresponde a trabajos y no está disponible para estudiantes.'
                );
        }

        // Graduado y docente → solamente trabajos
        if (
            in_array($tipoUsuario, ['graduado', 'docente'], true) &&
            $trabajo->tipo_oferta_id != 1
        ) {
            return redirect()
                ->route('web.ofertas.index')
                ->with(
                    'error',
                    'Esta oferta corresponde a pasantías y no está disponible para tu perfil.'
                );
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

        /*
    |--------------------------------------------------------------------------
    | OFERTAS RELACIONADAS
    |--------------------------------------------------------------------------
    */

        // Consulta base
        $queryRelacionados = Trabajo::where('activo', true)
            ->where('id', '!=', $trabajo->id)
            ->where('tipo_oferta_id', $trabajo->tipo_oferta_id)
            ->with([
                'categoria',
                'empresa',
                'tipoOferta',
                'modalidad',
            ]);

        // Primero buscamos por la misma categoría
        $porCategoria = (clone $queryRelacionados)
            ->where('categoria_id', $trabajo->categoria_id)
            ->latest('fecha_publicacion')
            ->take(3)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | COMPLETAR CON OFERTAS DE LA MISMA EMPRESA
    |--------------------------------------------------------------------------
    */

        $relacionados = $porCategoria;

        if ($relacionados->count() < 3) {

            $idsExcluir = $relacionados
                ->pluck('id')
                ->push($trabajo->id);

            $porEmpresa = (clone $queryRelacionados)
                ->where('empresa_id', $trabajo->empresa_id)
                ->whereNotIn('id', $idsExcluir)
                ->latest('fecha_publicacion')
                ->take(3 - $relacionados->count())
                ->get();

            $relacionados = $relacionados
                ->concat($porEmpresa);
        }

        return view('web.detalle', compact(
            'trabajo',
            'yaPostulado',
            'relacionados'
        ));
    }
    public function ofertas()
    {
        $usuario = Auth::user();

        $tipoUsuario = strtolower(
            (string) ($usuario?->tipoUsuario?->nombre ?? '')
        );

        $consulta = Trabajo::with([
            'categoria',
            'subcategoria',
            'empresa',
            'tipoOferta',
            'modalidad',
            'tipoContratacion',
        ])
            ->where('activo', true);

        // Estudiante → solamente pasantías
        if ($tipoUsuario === 'estudiante') {
            $consulta->where('tipo_oferta_id', 2);
        }

        // Graduado y docente → solamente trabajos
        if (in_array($tipoUsuario, ['graduado', 'docente'])) {
            $consulta->where('tipo_oferta_id', 1);
        }

        $trabajos = $consulta
            ->orderByDesc('fecha_publicacion')
            ->paginate(12);

        return view('web.ofertas.index', compact('trabajos'));
    }


    public function resultados()
    {
        $usuario = Auth::user();

        $tipoUsuario = strtolower(
            (string) ($usuario?->tipoUsuario?->nombre ?? '')
        );

        $consulta = Trabajo::with([
            'categoria',
            'subcategoria',
            'empresa',
            'tipoOferta',
            'modalidad',
            'tipoContratacion',
        ])->where('activo', true);

        // Respetar las ofertas permitidas según el tipo de usuario.
        if ($tipoUsuario === 'estudiante') {
            $consulta->where('tipo_oferta_id', 2);
        }

        if (in_array($tipoUsuario, ['graduado', 'docente'])) {
            $consulta->where('tipo_oferta_id', 1);
        }

        // Buscar por palabra clave.
        $palabraClave = request('palabra_clave');

        if ($palabraClave) {
            $consulta->where(function ($query) use ($palabraClave) {
                $query->where('titulo', 'like', "%{$palabraClave}%");
            });
        }

        // Filtrar por localidad, si se seleccionó.
        if (request('localidad_id')) {
            $consulta->whereHas('empresa', function ($query) {
                $query->where('localidad_id', request('localidad_id'));
            });
        }

        $trabajos = $consulta
            ->orderByDesc('fecha_publicacion')
            ->paginate(12)
            ->withQueryString();

        return view('web.ofertas.index', compact('trabajos'));
    }
    // ==================================================
    // CATEGORÍA PÚBLICA
    // ==================================================


    public function categoria(string $slug)
    {
        $categoria = Categoria::with([
            'subcategorias' => function ($query) {
                $query->where('activo', true)
                    ->orderBy('nombre');
            },
        ])
            ->where('slug', $slug)
            ->where('activo', true)
            ->firstOrFail();

        $consulta = Trabajo::with([
            'categoria',
            'subcategoria',
            'empresa',
            'tipoOferta',
            'modalidad',
            'tipoContratacion',
        ])
            ->where('activo', true)
            ->where('categoria_id', $categoria->id);

        $usuario = Auth::user();

        $tipoUsuario = strtolower(
            (string) ($usuario?->tipoUsuario?->nombre ?? '')
        );

        // Estudiante: solamente pasantías.
        if ($tipoUsuario === 'estudiante') {
            $consulta->where('tipo_oferta_id', 2);
        }

        // Graduado y docente: solamente trabajos.
        if (in_array($tipoUsuario, ['graduado', 'docente'], true)) {
            $consulta->where('tipo_oferta_id', 1);
        }

        $trabajos = $consulta
            ->orderByDesc('fecha_publicacion')
            ->paginate(12);

        return view('web.categorias.show', compact(
            'categoria',
            'trabajos'
        ));
    }



    // ==================================================
    // OFERTAS POR SUBCATEGORÍA
    // ==================================================

    public function subcategoria(string $categoriaSlug, string $subcategoriaSlug)
    {
        $categoria = Categoria::where('slug', $categoriaSlug)
            ->where('activo', true)
            ->firstOrFail();

        $subcategoria = Subcategoria::where('categoria_id', $categoria->id)
            ->where('slug', $subcategoriaSlug)
            ->where('activo', true)
            ->firstOrFail();

        $usuario = Auth::user();

        $tipoUsuario = strtolower(
            (string) ($usuario?->tipoUsuario?->nombre ?? '')
        );

        $consulta = Trabajo::with([
            'categoria',
            'subcategoria',
            'empresa',
            'tipoOferta',
            'modalidad',
            'tipoContratacion',
        ])
            ->where('activo', true)
            ->where('categoria_id', $categoria->id)
            ->where('subcategoria_id', $subcategoria->id);

        // Estudiante: solamente pasantías.
        if ($tipoUsuario === 'estudiante') {
            $consulta->where('tipo_oferta_id', 2);
        }

        // Graduado y docente: solamente trabajos.
        if (in_array($tipoUsuario, ['graduado', 'docente'], true)) {
            $consulta->where('tipo_oferta_id', 1);
        }

        $trabajos = $consulta
            ->orderByDesc('fecha_publicacion')
            ->paginate(12);

        return view('web.ofertas.index', compact(
            'trabajos',
            'categoria',
            'subcategoria'
        ));
    }
}
