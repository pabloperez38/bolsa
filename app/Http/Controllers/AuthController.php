<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\PersonaInstitucional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLogin()
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

        return view('web.auth.login', compact('categorias'));
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'El campo email es obligatorio.',
                'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
                'password.required' => 'El campo contraseña es obligatorio.',
            ]
        );

        if (!Auth::attempt($credenciales, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'El email o la contraseña son incorrectos.',
                    'password' => 'El email o la contraseña son incorrectos.',
                ])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        $usuario = Auth::user();

        $tipoUsuario = $usuario->tipoUsuario->nombre;

        switch ($tipoUsuario) {

            case 'administrador':
                return redirect('/admin');

            case 'Empresa':
                return redirect('/empresa');

            case 'estudiante':
            case 'graduado':
            case 'docente':
                return redirect('/usuario');

            default:
                Auth::logout();

                return redirect()
                    ->route('login')
                    ->withErrors([
                        'email' => 'El tipo de usuario no es válido.',
                    ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('web.index');
    }

    public function showRegister()
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

        return view('web.auth.register', compact('categorias'));
    }

    //Registro de candidadtos 
    public function registroCandidato(Request $request)
    {
        // Validamos los datos ingresados
        $request->validate(
            [
                'tipo' => [
                    'required',
                    'in:estudiante,graduado,docente',
                ],

                'dni' => [
                    'required',
                    'string',
                ],

                'legajo' => [
                    'required',
                    'string',
                ],

                'email' => [
                    'required',
                    'email',
                    'unique:users,email',
                ],

                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                ],

                'terminos' => [
                    'accepted',
                ],
            ],
            [
                // Tipo de usuario
                'tipo.required' => 'Debe seleccionar un tipo de usuario.',
                'tipo.in' => 'El tipo de usuario seleccionado no es válido.',

                // DNI
                'dni.required' => 'El DNI es obligatorio.',
                'dni.string' => 'El DNI debe ser un texto válido.',

                // Legajo
                'legajo.required' => 'El legajo es obligatorio.',
                'legajo.string' => 'El legajo debe ser un texto válido.',

                // Email
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'Debe ingresar un correo electrónico válido.',
                'email.unique' => 'El correo electrónico ingresado ya está registrado.',

                // Contraseña
                'password.required' => 'La contraseña es obligatoria.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'password.min' => 'La contraseña debe tener al menos :min caracteres.',

                // Términos
                'terminos.accepted' => 'Debe aceptar los términos de uso para registrarse.',
            ],
            [
                'tipo' => 'tipo de usuario',
                'dni' => 'DNI',
                'legajo' => 'legajo',
                'email' => 'correo electrónico',
                'password' => 'contraseña',
                'terminos' => 'términos de uso',
            ]
        );

        // Buscamos a la persona en el padrón institucional
        $persona = PersonaInstitucional::where('dni', $request->dni)
            ->where('legajo', $request->legajo)
            ->where('tipo', $request->tipo)
            ->where('activo', true)
            ->first();

        // Si no existe en el padrón, no puede registrarse
        if (!$persona) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Los datos ingresados no coinciden con los registros institucionales.');
        }

        // Verificamos que esa persona todavía no tenga una cuenta
        if ($persona->usuario) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Esta persona ya tiene una cuenta registrada.');
        }

        // Buscamos el tipo de usuario
        $tipoUsuario = \App\Models\TipoUsuario::where(
            'nombre',
            $request->tipo
        )->first();

        if (!$tipoUsuario) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'El tipo de usuario no está configurado correctamente.');
        }

        // Creamos la cuenta
        $usuario = User::create([
            'name' => $persona->nombre . ' ' . $persona->apellido,
            'email' => $request->email,
            'password' => $request->password,
            'tipo_usuario_id' => $tipoUsuario->id,
            'persona_institucional_id' => $persona->id,
        ]);

        $usuario->perfil()->create([
            'nombre' => $persona->nombre,
            'apellido' => $persona->apellido,
            'dni' => $persona->dni,
            'legajo' => $persona->legajo,
        ]);

        // Iniciamos sesión automáticamente
        // Auth::login($usuario);

        // Regeneramos la sesión por seguridad
        //$request->session()->regenerate();

        event(new Registered($usuario));

        return redirect()
            ->route('registro.exito')
            ->with(
                'success',
                'Registro realizado correctamente. Revisá tu correo electrónico para confirmar tu cuenta.'
            );
    }

    public function verificarEmail(Request $request, $id, $hash)
    {
        $usuario = User::findOrFail($id);

        // Verificamos que el hash corresponda al email del usuario
        if (! hash_equals(
            sha1($usuario->getEmailForVerification()),
            $hash
        )) {
            abort(403, 'El enlace de verificación no es válido.');
        }

        // Si ya estaba verificado
        if ($usuario->hasVerifiedEmail()) {
            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Tu cuenta ya estaba verificada. Ahora podés iniciar sesión.'
                );
        }

        // Marcamos el email como verificado
        $usuario->markEmailAsVerified();

        return redirect()
            ->route('login')
            ->with(
                'success',
                '¡Cuenta verificada correctamente! Ya podés iniciar sesión.'
            );
    }
}
