<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Obtener los datos del usuario desde Google
        $googleUser = Socialite::driver('google')->user();

        // Buscar si ya existe una cuenta con ese email
        $usuario = User::where('email', $googleUser->email)->first();

        // ---------------------------------------------------------
        // SI NO EXISTE LA CUENTA
        // ---------------------------------------------------------
        if (!$usuario) {

            // Guardamos temporalmente los datos de Google
            // para continuar el registro institucional
            session([
                'google_register' => [
                    'google_id' => $googleUser->id,
                    'email' => $googleUser->email,
                    'name' => $googleUser->name,
                ],
            ]);

            return redirect()
                ->route('register')
                ->with(
                    'error',
                    'No existe una cuenta asociada a este correo. Para registrarse, primero debe validar su DNI y número de legajo.'
                );
        }

        // ---------------------------------------------------------
        // SI LA CUENTA YA EXISTE
        // ---------------------------------------------------------

        // Si todavía no tiene Google asociado,
        // guardamos el ID de Google
        if (!$usuario->google_id) {

            $usuario->google_id = $googleUser->id;
            $usuario->save();
        }

        // Iniciamos sesión
        Auth::login($usuario);

        // Regeneramos la sesión por seguridad
        request()->session()->regenerate();

        // Obtener tipo de usuario
        $tipoUsuario = strtolower(
            (string) ($usuario->tipoUsuario?->nombre ?? '')
        );

        // Los administradores no necesitan verificar email
        if (
            $tipoUsuario !== 'administrador'
            && !$usuario->hasVerifiedEmail()
        ) {

            Auth::logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'warning',
                    'Debés confirmar tu correo electrónico antes de iniciar sesión.'
                );
        }

        // Redirección según tipo de usuario
        switch ($tipoUsuario) {

            case 'administrador':
                return redirect('/admin');

            case 'empresa':
                return redirect('/empresa');

            case 'estudiante':
            case 'graduado':
            case 'docente':

                // Si el perfil está completo
                if (
                    $usuario->perfil
                    && $usuario->perfil->estaCompleto()
                ) {
                    return redirect('/usuario');
                }

                // Si el perfil está incompleto
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
}
