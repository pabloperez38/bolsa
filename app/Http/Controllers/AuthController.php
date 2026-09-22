<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!Auth::attempt($credenciales)) {
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

            case 'organizacion':
                return redirect('/organizacion');

            case 'estudiante':
            case 'graduado':
            case 'personal':
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

        return redirect()->route('login');
    }
}
