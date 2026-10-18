
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Illuminate\Support\Facades\Artisan;

// =====================================================
// AUTENTICACIÓN CON GOOGLE
// =====================================================

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');

// =====================================================
// SITIO PÚBLICO
// =====================================================

Route::get('/', [WebController::class, 'index'])
    ->name('web.index');

Route::get('/ofertas', [WebController::class, 'ofertas'])
    ->name('web.ofertas.index');

Route::get('/oferta/{slug}/{id}', [WebController::class, 'detalle'])
    ->name('web.oferta.detalle');

Route::get('/ofertas/resultados', [WebController::class, 'resultados'])
    ->name('web.ofertas.resultados');

Route::get('/categorias/{slug}', [WebController::class, 'categoria'])
    ->name('web.categorias.show');

Route::get('/ofertas/{categoriaSlug}/{subcategoriaSlug}', [WebController::class, 'subcategoria'])->name('web.ofertas.subcategoria');

// =====================================================
// LOGIN, REGISTRO Y RECUPERACIÓN DE CONTRASEÑA
// =====================================================

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'registroCandidato']);

    // Autenticación en dos pasos durante el login
    Route::get('/usuario/2fa/login', [AuthController::class, 'twoFactorLogin'])
        ->name('usuario.2fa.login');

    Route::post('/usuario/2fa/login', [AuthController::class, 'twoFactorLoginVerify'])
        ->name('usuario.2fa.login.verify');

    Route::get('/reset-password/{token}', function (
        Request $request,
        string $token
    ) {
        return view('web.auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    })->name('password.reset');
});

Route::get('/email/verificar/{id}/{hash}', [
    AuthController::class,
    'verificarEmail',
])->middleware('signed')->name('verification.verify');

Route::get('/recuperar', [AuthController::class, 'passwordResetRequest'])
    ->name('password.request');

// =====================================================
// REGISTRO DE CANDIDATOS Y EMPRESAS
// =====================================================

Route::post('/registro/candidato', [AuthController::class, 'registroCandidato'])
    ->name('registro.candidato');

Route::post('/registro/empresa', [AuthController::class, 'registroEmpresa'])
    ->name('registro.empresa');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// =====================================================
// ADMINISTRACIÓN
// =====================================================

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::prefix('admin')->name('admin.')->group(function () {

        // Usuarios
        Route::get('/usuarios', [EmpresaController::class, 'usuarios'])
            ->name('usuarios.index');

        // Ofertas laborales
        Route::get('/ofertas-laborales', [EmpresaController::class, 'ofertasLaborales'])
            ->name('ofertas-laborales.index');

        // Empresas
        Route::get('/empresas', [EmpresaController::class, 'index'])
            ->name('empresa.index');

        // Categorías
        Route::prefix('categorias')->name('categorias.')->group(function () {

            Route::get('/', [CategoriaController::class, 'categorias'])
                ->name('index');

            Route::get('/create', [CategoriaController::class, 'create'])
                ->name('create');

            Route::post('/', [CategoriaController::class, 'storeCategoria'])
                ->name('store');

            Route::get('/{id}/edit', [CategoriaController::class, 'editCategoria'])
                ->name('edit');

            Route::put('/{id}', [CategoriaController::class, 'updateCategoria'])
                ->name('update');

            Route::delete('/{id}', [CategoriaController::class, 'destroyCategoria'])
                ->name('destroy');

            Route::post('/{id}/restore', [CategoriaController::class, 'restoreCategoria'])
                ->name('restore');
        });
    });
});

// =====================================================
// PANEL DE EMPRESA
// =====================================================

Route::middleware(['auth', 'empresa'])
    ->prefix('empresa')
    ->name('empresa.')
    ->group(function () {

        Route::get('/', [EmpresaController::class, 'dashboard'])
            ->name('index');

        Route::get('/perfil', [EmpresaController::class, 'perfil'])
            ->name('perfil');

        Route::put('/perfil', [EmpresaController::class, 'update'])
            ->name('perfil.update');

        Route::get('/mis-publicaciones', [EmpresaController::class, 'misPublicaciones'])
            ->name('mis-publicaciones');
    });

// =====================================================
// PANEL DE USUARIOS
// =====================================================

Route::middleware(['auth', 'usuario'])
    ->prefix('usuario')
    ->name('usuario.')
    ->group(function () {

        Route::get('/', [UsuarioController::class, 'index'])
            ->name('index');

        // Perfil del usuario
        Route::get('/perfil', [PerfilController::class, 'edit'])
            ->name('perfil');

        Route::put('/perfil', [PerfilController::class, 'update'])
            ->name('perfil.update');

        // Funciones que requieren perfil completo
        Route::middleware('perfil.completo')->group(function () {

            Route::get('/postulaciones', [UsuarioController::class, 'postulaciones'])
                ->name('postulaciones');

            Route::get('/trabajos', [UsuarioController::class, 'trabajos'])
                ->name('trabajos');

            Route::get('/pasantias', [UsuarioController::class, 'pasantias'])
                ->name('pasantias');

            Route::post('/postularse/{id}', [UsuarioController::class, 'postularse'])
                ->name('postularse');
        });

        // Retirar postulación
        Route::delete('/postulaciones/{id}/retirar', [
            UsuarioController::class,
            'retirarPostulacion',
        ])->name('postulaciones.retirar');
    });

// =====================================================
// AUTENTICACIÓN EN DOS PASOS
// Compartida por usuarios y empresas
// =====================================================

Route::middleware('auth')->group(function () {

    Route::post('/usuario/2fa', [
        TwoFactorAuthenticationController::class,
        'store',
    ])->name('usuario.2fa.enable');

    Route::delete('/usuario/2fa', [
        TwoFactorAuthenticationController::class,
        'destroy',
    ])->name('usuario.2fa.disable');

    Route::get('/usuario/2fa/qr', [PerfilController::class, 'twoFactorQr'])
        ->name('usuario.2fa.qr');

    Route::post('/usuario/2fa/confirmar', [PerfilController::class, 'twoFactorConfirm'])
        ->name('usuario.2fa.confirmar');

    Route::get('/usuario/2fa/codigos-recuperacion', [
        PerfilController::class,
        'twoFactorRecoveryCodes',
    ])->name('usuario.2fa.recovery-codes');

    Route::post('/usuario/2fa/codigos-recuperacion/regenerar', [
        PerfilController::class,
        'twoFactorRegenerateRecoveryCodes',
    ])->name('usuario.2fa.recovery-codes.regenerate');
});

// =====================================================
// TOKEN CSRF
// =====================================================

Route::get('/csrf-token', function () {
    return response()->json([
        'token' => csrf_token(),
    ]);
})->name('web.csrf');

/* Route::get('/generar-storage', function () {
    $target = '/home/sistemadeventas/domains/sistemadeventas.com.ar/storage/app/public';

    // Cambiamos 'public' por 'public_html' (o la carpeta pública real de tu hosting)
    $link = '/home/sistemadeventas/domains/sistemadeventas.com.ar/public_html/storage';

    if (file_exists($link)) {
        if (is_link($link)) {
            unlink($link);
        } else {
            rmdir($link);
        }
    }

    if (symlink($target, $link)) {
        return '¡Enlace simbólico creado correctamente en public_html/storage!';
    }

    return 'No se pudo crear el enlace.';
});
 */