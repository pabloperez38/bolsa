<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Provincia;
use App\Models\Localidad;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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



    public function perfil()
    {
        $usuario = Auth::user();

        $empresa = $usuario->empresa;

        $provincias = Provincia::orderBy('nombre')->get();

        $localidades = Localidad::select(
            'id',
            'provincia_id',
            'nombre'
        )->orderBy('nombre')->get();

        // Provincia asociada a la localidad actual de la empresa.
        // Si hubo un error de validación, conservar lo seleccionado.
        $provinciaSeleccionada = old(
            'provincia_id',
            $empresa?->localidad?->provincia_id
        );

        return view(
            'empresa.perfil.index',
            compact(
                'empresa',
                'provincias',
                'localidades',
                'provinciaSeleccionada'
            )
        );
    }

    public function misPublicaciones()
    {
        $usuario = Auth::user();
        $empresa = $usuario->empresa;

        $publicaciones = Trabajo::where('empresa_id', $empresa->id)
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view(
            'empresa.mis-publicaciones.index',
            compact('empresa', 'publicaciones')
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



    public function update(Request $request)
    {
        $usuario = Auth::user();
        $empresa = $usuario->empresa;

        if (!$empresa) {
            abort(403, 'La cuenta no tiene una empresa asociada.');
        }

        $validated = $request->validate([
            // Datos de la empresa
            'nombre' => ['required', 'string', 'max:150'],
            'cuit' => ['required', 'string', 'max:20'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'sitio_web' => ['nullable', 'url', 'max:255'],
            'direccion' => ['nullable', 'string', 'max:255'],

            // Ubicación
            'provincia_id' => [
                'required',
                'integer',
                'exists:provincias,id',
            ],
            'localidad_id' => [
                'required',
                'integer',
                Rule::exists('localidades', 'id')
                    ->where('provincia_id', $request->input('provincia_id')),
            ],

            // Correo de inicio de sesión
            'email_acceso' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($usuario->id),
            ],

            // Cambio de contraseña opcional
            'password_actual' => [
                'nullable',
                'required_with:password',
                'current_password',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'email_acceso.required' => 'El correo de acceso es obligatorio.',
            'email_acceso.email' => 'Ingresá un correo de acceso válido.',
            'email_acceso.unique' => 'Ese correo ya está registrado por otra cuenta.',
            'provincia_id.required' => 'Seleccioná una provincia.',
            'provincia_id.exists' => 'La provincia seleccionada no es válida.',
            'localidad_id.required' => 'Seleccioná una localidad.',
            'localidad_id.exists' => 'La localidad no corresponde a la provincia seleccionada.',
            'password_actual.required_with' => 'Ingresá tu contraseña actual para cambiarla.',
            'password_actual.current_password' => 'La contraseña actual es incorrecta.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        // Actualizar los datos de la empresa.
        $empresa->update([
            'nombre' => $validated['nombre'],
            'cuit' => $validated['cuit'],
            'descripcion' => $validated['descripcion'] ?? null,
            'email' => $validated['email'],
            'telefono' => $validated['telefono'] ?? null,
            'sitio_web' => $validated['sitio_web'] ?? null,
            'direccion' => $validated['direccion'] ?? null,
            'localidad_id' => $validated['localidad_id'],
        ]);

        // Actualizar el correo de inicio de sesión.
        $usuario->email = $validated['email_acceso'];

        // Cambiar la contraseña solamente si se completó el campo.
        if (!empty($validated['password'])) {
            $usuario->password = Hash::make($validated['password']);
        }

        $usuario->save();

        return redirect()
            ->route('empresa.perfil')
            ->with('success', 'Los datos de la empresa se actualizaron correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $Empresa)
    {
        //
    }
}
