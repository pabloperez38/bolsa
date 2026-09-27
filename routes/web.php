<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [WebController::class, 'index'])->name('web.index');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::get('/registro/exito', function () {
    return view('web.index');
})->name('registro.exito');

Route::get('/email/verificar/{id}/{hash}', [AuthController::class, 'verificarEmail'])
    ->middleware('signed')
    ->name('verification.verify');

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
});

//Usuarios
Route::get('/usuario', [UsuarioController::class, 'index'])
    ->middleware('auth', 'usuario', 'perfil.completo')
    ->name('usuario.index');

Route::get('/usuario/postulaciones', [UsuarioController::class, 'postulaciones'])
    ->middleware('auth', 'usuario', 'perfil.completo')
    ->name('usuario.postulaciones');


Route::middleware(['auth', 'usuario'])->group(function () {

    Route::get('/usuario/perfil', [PerfilController::class, 'edit'])
        ->name('usuario.perfil');

    Route::put('/usuario/perfil', [PerfilController::class, 'update'])
        ->name('usuario.perfil.update');
});
