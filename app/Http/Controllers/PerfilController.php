<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    /**
     * Mostrar el perfil del usuario autenticado.
     */
    public function edit()
    {
        $usuario = Auth::user();

        $perfil = $usuario->perfil;

        $localidades = Localidad::where('activo', true)
            ->orderBy('nombre')
            ->get();

        return view('usuario.perfil.index', compact(
            'usuario',
            'perfil',
            'localidades'
        ));
    }

    /**
     * Guardar o actualizar el perfil.
     */

    public function update(Request $request)
    {
        $usuario = Auth::user();

        /*
    |--------------------------------------------------------------------------
    | Validación
    |--------------------------------------------------------------------------
    */

        $datos = $request->validate(
            [

                // ==========================================
                // DATOS DE USERS
                // ==========================================

                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                // ==========================================
                // DATOS DE PERFIL
                // ==========================================

                'dni' => [
                    'nullable',
                    'digits_between:7,8',
                    'unique:perfiles,dni,' . optional($usuario->perfil)->id,
                ],

                'telefono' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'fecha_nacimiento' => [
                    'nullable',
                    'date',
                    'before:today',
                ],

                'direccion' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'localidad_id' => [
                    'nullable',
                    'exists:localidades,id',
                ],

                'biografia' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],

                'linkedin' => [
                    'nullable',
                    'url',
                    'max:255',
                ],

                'sitio_web' => [
                    'nullable',
                    'url',
                    'max:255',
                ],

                // ==========================================
                // FOTO
                // ==========================================

                'foto' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png',
                    'max:2048',
                ],

                // ==========================================
                // CV
                // ==========================================

                'cv' => [
                    'nullable',
                    'file',
                    'mimes:pdf',
                    'max:5120',
                ],
            ],

            [

                // ==========================================
                // MENSAJES PERSONALIZADOS
                // ==========================================

                'name.required' =>
                'El nombre y apellido son obligatorios.',

                'name.string' =>
                'El nombre y apellido no son válidos.',

                'name.max' =>
                'El nombre y apellido no pueden superar los 255 caracteres.',

                'dni.digits_between' =>
                'El DNI debe contener entre 7 y 8 números.',

                'dni.unique' =>
                'El DNI ya está registrado.',

                'telefono.string' =>
                'El teléfono no es válido.',

                'telefono.max' =>
                'El teléfono no puede superar los 50 caracteres.',

                'fecha_nacimiento.date' =>
                'La fecha de nacimiento no es válida.',

                'fecha_nacimiento.before' =>
                'La fecha de nacimiento debe ser anterior a la fecha actual.',

                'direccion.max' =>
                'La dirección no puede superar los 255 caracteres.',

                'localidad_id.exists' =>
                'La localidad seleccionada no es válida.',

                'biografia.max' =>
                'La biografía no puede superar los 5000 caracteres.',

                'linkedin.url' =>
                'El enlace de LinkedIn no es válido.',

                'linkedin.max' =>
                'El enlace de LinkedIn no puede superar los 255 caracteres.',

                'sitio_web.url' =>
                'El sitio web no es válido.',

                'sitio_web.max' =>
                'El sitio web no puede superar los 255 caracteres.',

                'foto.image' =>
                'El archivo seleccionado debe ser una imagen.',

                'foto.mimes' =>
                'La foto debe estar en formato JPG, JPEG o PNG.',

                'foto.max' =>
                'La foto no puede superar los 2 MB.',

                'cv.file' =>
                'El archivo seleccionado no es válido.',

                'cv.mimes' =>
                'El CV debe estar en formato PDF.',

                'cv.max' =>
                'El CV no puede superar los 5 MB.',
            ]
        );


        /*
    |--------------------------------------------------------------------------
    | Actualizar users
    |--------------------------------------------------------------------------
    */

        $usuario->update([
            'name' => $datos['name'],
        ]);


        /*
    |--------------------------------------------------------------------------
    | Datos que pertenecen a perfiles
    |--------------------------------------------------------------------------
    */

        $datosPerfil = [

            'dni' => $datos['dni'] ?? null,

            'telefono' => $datos['telefono'] ?? null,

            'fecha_nacimiento' => $datos['fecha_nacimiento'] ?? null,

            'direccion' => $datos['direccion'] ?? null,

            'localidad_id' => $datos['localidad_id'] ?? null,

            'biografia' => $datos['biografia'] ?? null,

            'linkedin' => $datos['linkedin'] ?? null,

            'sitio_web' => $datos['sitio_web'] ?? null,
        ];


        /*
    |--------------------------------------------------------------------------
    | Guardar foto
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('foto')) {

            $datosPerfil['foto'] = $request
                ->file('foto')
                ->store('perfiles/fotos', 'public');
        }


        /*
    |--------------------------------------------------------------------------
    | Guardar CV
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('cv')) {

            $datosPerfil['cv'] = $request
                ->file('cv')
                ->store('perfiles/cv', 'public');
        }


        /*
    |--------------------------------------------------------------------------
    | Crear o actualizar perfil
    |--------------------------------------------------------------------------
    */

        Perfil::updateOrCreate(
            [
                'user_id' => $usuario->id,
            ],
            $datosPerfil
        );


        /*
    |--------------------------------------------------------------------------
    | Redireccionar
    |--------------------------------------------------------------------------
    */

        return redirect()
            ->route('usuario.perfil')
            ->with(
                'success',
                'Tu perfil fue actualizado correctamente.'
            );
    }
}
