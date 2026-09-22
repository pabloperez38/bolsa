<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizacionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('web.index');


Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth', 'admin')
    ->name('admin.index');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

//Usuarios
Route::get('/usuario', [UsuarioController::class, 'index'])
    ->middleware('auth', 'usuario')
    ->name('usuario.index');

Route::middleware(['auth', 'usuario'])->group(function () {

    Route::get('/usuario/perfil', [PerfilController::class, 'edit'])
        ->name('usuario.perfil');

    Route::put('/usuario/perfil', [PerfilController::class, 'update'])
        ->name('usuario.perfil.update');
});

Route::get('/organizacion', [OrganizacionController::class, 'index'])
    ->middleware('auth', 'organizacion')
    ->name('organizacion.index');
