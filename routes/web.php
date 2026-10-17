<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Illuminate\Http\Request;


Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');

Route::get('/', [WebController::class, 'index'])->name('web.index');

Route::get('/oferta/{slug}/{id}', [WebController::class, 'detalle'])
    ->name('web.oferta.detalle');

Route::get('/ofertas', [WebController::class, 'ofertas'])
    ->name('web.ofertas.index');

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'registroCandidato']);

    // Autenticación en dos pasos durante el login
    Route::get('/usuario/2fa/login', [AuthController::class, 'twoFactorLogin'])->name('usuario.2fa.login');

    Route::post('/usuario/2fa/login', [AuthController::class, 'twoFactorLoginVerify'])->name('usuario.2fa.login.verify');
});

Route::get('/email/verificar/{id}/{hash}', [AuthController::class, 'verificarEmail'])
    ->middleware('signed')
    ->name('verification.verify');

Route::get('/recuperar', [AuthController::class, 'passwordResetRequest'])
    ->name('password.request');

Route::get('/reset-password/{token}', function (
    Request $request,
    string $token
) {
    return view('web.auth.reset-password', [
        'token' => $token,
        'email' => $request->query('email'),
    ]);
})->middleware('guest')->name('password.reset');

// =====================================================
// REGISTRO
// =====================================================

Route::post('/registro/candidato', [AuthController::class, 'registroCandidato'])
    ->name('registro.candidato');

Route::post('/registro/empresa', [AuthController::class, 'registroEmpresa'])
    ->name('registro.empresa');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


//Rutas de admin

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::prefix('admin')->group(function () {
        Route::get('/usuarios', [EmpresaController::class, 'usuarios'])
            ->name('admin.usuarios.index');
    });
    Route::prefix('admin')->group(function () {
        Route::get('/ofertas-laborales', [EmpresaController::class, 'ofertasLaborales'])
            ->name('admin.ofertas-laborales.index');
    });
    Route::prefix('admin')->group(function () {
        Route::get('/empresas', [EmpresaController::class, 'index'])
            ->name('admin.empresa.index');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/categorias', [CategoriaController::class, 'categorias'])
            ->name('admin.categorias.index');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/categorias/create', [CategoriaController::class, 'create'])
            ->name('admin.categorias.create');

        Route::post('/categorias', [CategoriaController::class, 'storeCategoria'])
            ->name('admin.categorias.store');

        Route::get('/categorias/{id}/edit', [CategoriaController::class, 'editCategoria'])
            ->name('admin.categorias.edit');

        Route::put('/categorias/{id}', [CategoriaController::class, 'updateCategoria'])
            ->name('admin.categorias.update');

        Route::delete('/categorias/{id}', [CategoriaController::class, 'destroyCategoria'])
            ->name('admin.categorias.destroy');

        Route::post(
            '/categorias/{id}/restore',
            [CategoriaController::class, 'restoreCategoria']
        )->name('admin.categorias.restore');
    });
});

Route::middleware(['auth', 'empresa'])->group(function () {
    Route::get('/empresa', [EmpresaController::class, 'dashboard'])
        ->name('empresa.index');

    Route::get('/Empresa', [EmpresaController::class, 'dashboard'])
        ->name('empresa.index.uppercase');

    Route::get('/empresa/perfil', [EmpresaController::class, 'perfil'])
        ->name('empresa.perfil');
});

//Usuarios
Route::get('/usuario', [UsuarioController::class, 'index'])
    ->middleware('auth', 'usuario')
    ->name('usuario.index');

Route::get('/usuario/postulaciones', [UsuarioController::class, 'postulaciones'])
    ->middleware('auth', 'usuario', 'perfil.completo')
    ->name('usuario.postulaciones');

Route::get('/usuario/trabajos', [UsuarioController::class, 'trabajos'])
    ->middleware('auth', 'usuario', 'perfil.completo')
    ->name('usuario.trabajos');

Route::get('/usuario/pasantias', [UsuarioController::class, 'pasantias'])
    ->middleware('auth', 'usuario', 'perfil.completo')
    ->name('usuario.pasantias');

Route::post('/usuario/postularse/{id}', [UsuarioController::class, 'postularse'])
    ->middleware(['auth', 'usuario', 'perfil.completo'])
    ->name('usuario.postularse');

Route::delete(
    '/usuario/postulaciones/{id}/retirar',
    [UsuarioController::class, 'retirarPostulacion']
)->name('usuario.postulaciones.retirar');;

Route::middleware(['auth', 'usuario'])->group(function () {

    Route::get('/usuario/perfil', [PerfilController::class, 'edit'])
        ->name('usuario.perfil');

    Route::put('/usuario/perfil', [PerfilController::class, 'update'])
        ->name('usuario.perfil.update');

    Route::post('/usuario/2fa', [TwoFactorAuthenticationController::class, 'store'])
        ->name('usuario.2fa.enable');

    Route::delete('/usuario/2fa', [TwoFactorAuthenticationController::class, 'destroy'])
        ->name('usuario.2fa.disable');

    Route::get('/usuario/2fa/qr', [PerfilController::class, 'twoFactorQr'])->name('usuario.2fa.qr');

    Route::post('/usuario/2fa/confirmar', [PerfilController::class, 'twoFactorConfirm'])->name('usuario.2fa.confirmar');

    Route::get('/usuario/2fa/codigos-recuperacion', [PerfilController::class, 'twoFactorRecoveryCodes'])->name('usuario.2fa.recovery-codes');

    Route::post('/usuario/2fa/codigos-recuperacion/regenerar', [
        PerfilController::class,
        'twoFactorRegenerateRecoveryCodes'
    ])->name('usuario.2fa.recovery-codes.regenerate');
});
Route::get('/csrf-token', function () {
    return response()->json([
        'token' => csrf_token(),
    ]);
})->name('web.csrf');
