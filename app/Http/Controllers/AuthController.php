<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\PersonaInstitucional;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLogin()
    {

        return view('web.auth.login');
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

        // Recuperar usuario autenticado
        $usuario = Auth::user();

        // Obtener tipo de usuario
        $tipoUsuario = strtolower((string) ($usuario->tipoUsuario?->nombre ?? ''));

        // Verificar que el email haya sido confirmado.
        // Los administradores NO necesitan verificar su email.
        if ($tipoUsuario !== 'administrador' && !$usuario->hasVerifiedEmail()) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withInput($request->only('email'))
                ->with(
                    'warning',
                    'Debés confirmar tu correo electrónico antes de iniciar sesión.'
                );
        }

        // Regenerar la sesión después del login correcto
        $request->session()->regenerate();

        switch ($tipoUsuario) {

            case 'administrador':
                return redirect('/admin');

            case 'empresa':
                return redirect('/empresa');

            case 'estudiante':
            case 'graduado':
            case 'docente':

                // Si el perfil está completo → usuario
                if ($usuario->perfil && $usuario->perfil->estaCompleto()) {
                    return redirect('/usuario');
                }

                // Si el perfil está incompleto → completar perfil
                return redirect('/usuario/perfil');

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

    // Registro de candidatos
    public function registroCandidato(Request $request)
    {
        // Detectamos si el registro comenzó desde Google
        $googleRegister = session('google_register');

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

        // Si el registro comenzó desde Google,
        // verificamos que el email coincida con el email de Google
        if ($googleRegister && $request->email !== $googleRegister['email']) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with(
                    'error',
                    'El correo electrónico no coincide con la cuenta de Google utilizada para registrarse.'
                );
        }

        // Buscamos a la persona en el padrón institucional
        $persona = PersonaInstitucional::where('dni', $request->dni)
            ->where('legajo', $request->legajo)
            ->where('tipo', $request->tipo)
            ->where('activo', true)
            ->first();

        $carrera = null;

        if ($persona && !empty($persona->carrera)) {
            $carrera = Carrera::where('nombre', $persona->carrera)->first();
        }

        // Si no existe en el padrón, no puede registrarse
        if (!$persona) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with(
                    'error',
                    'Los datos ingresados no coinciden con los registros institucionales.'
                );
        }

        // Verificamos que esa persona todavía no tenga una cuenta
        if ($persona->usuario) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with(
                    'error',
                    'Esta persona ya tiene una cuenta registrada.'
                );
        }

        // Buscamos el tipo de usuario
        $tipoUsuario = TipoUsuario::where(
            'nombre',
            $request->tipo
        )->first();

        if (!$tipoUsuario) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with(
                    'error',
                    'El tipo de usuario no está configurado correctamente.'
                );
        }

        // Creamos la cuenta
        $usuario = User::create([
            'name' => $persona->nombre . ' ' . $persona->apellido,
            'email' => $request->email,
            'password' => $request->password,
            'tipo_usuario_id' => $tipoUsuario->id,

            // Si viene desde Google, guardamos el ID de Google.
            // Si es un registro normal, queda en null.
            'google_id' => $googleRegister['google_id'] ?? null,
        ]);

        // Creamos el perfil
        $usuario->perfil()->create([
            'nombre' => $persona->nombre,
            'apellido' => $persona->apellido,
            'dni' => $persona->dni,
            'legajo' => $persona->legajo,
            'carrera_id' => $carrera?->id,
            'materias_aprobadas' => $persona->materias_aprobadas ?? null,
        ]);

        // Eliminamos los datos temporales de Google
        session()->forget('google_register');

        // NO iniciamos sesión automáticamente
        // Auth::login($usuario);
        // $request->session()->regenerate();

        // Enviamos correo de verificación
        event(new Registered($usuario));

        return redirect()
            ->route('web.index')
            ->with(
                'success',
                'Registro realizado correctamente. Revisá tu correo electrónico para confirmar tu cuenta.'
            );
    }
    public function registroEmpresa(Request $request)
    {
        $request->validate(
            [
                'razon_social' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'cuit' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:empresas,cuit',
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
                // Razón social
                'razon_social.required' =>
                'La razón social o nombre de la empresa es obligatorio.',

                'razon_social.string' =>
                'La razón social debe ser un texto válido.',

                'razon_social.max' =>
                'La razón social no puede superar los 255 caracteres.',

                // CUIT
                'cuit.required' =>
                'El CUIT es obligatorio.',

                'cuit.string' =>
                'El CUIT debe ser un texto válido.',

                'cuit.max' =>
                'El CUIT no puede superar los 20 caracteres.',

                'cuit.unique' =>
                'El CUIT ingresado ya está registrado.',

                // Email
                'email.required' =>
                'El correo electrónico es obligatorio.',

                'email.email' =>
                'Debe ingresar un correo electrónico válido.',

                'email.unique' =>
                'El correo electrónico ingresado ya está registrado.',

                // Contraseña
                'password.required' =>
                'La contraseña es obligatoria.',

                'password.confirmed' =>
                'Las contraseñas no coinciden.',

                'password.min' =>
                'La contraseña debe tener al menos :min caracteres.',

                // Términos
                'terminos.accepted' =>
                'Debe aceptar los términos de uso para registrarse.',
            ],
            [
                'razon_social' => 'razón social',
                'cuit' => 'CUIT',
                'email' => 'correo electrónico',
                'password' => 'contraseña',
                'terminos' => 'términos de uso',
            ]
        );

        // Buscamos el tipo de usuario EMPRESA
        $tipoUsuario = TipoUsuario::where('nombre', 'empresa')->first();

        if (!$tipoUsuario) {

            return back()
                ->withInput(
                    $request->except(
                        'password',
                        'password_confirmation'
                    )
                )
                ->with(
                    'error',
                    'El tipo de usuario empresa no está configurado correctamente.'
                );
        }

        // Creamos el usuario
        $usuario = User::create([
            'name' => $request->razon_social,
            'email' => $request->email,
            'password' => $request->password,
            'tipo_usuario_id' => $tipoUsuario->id,
        ]);

        // Creamos la empresa asociada al usuario
        $empresa = Empresa::create([
            'user_id' => $usuario->id,
            'nombre' => $request->razon_social,
            'cuit' => $request->cuit,
            'email' => $request->email,
        ]);
        // NO iniciamos sesión automáticamente
        // Auth::login($usuario);

        // Enviamos correo de verificación
        event(new Registered($usuario));

        return redirect()
            ->route('web.index')
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

    public function passwordResetRequest()
    {
        return view('web.auth.recovery');
    }
}
