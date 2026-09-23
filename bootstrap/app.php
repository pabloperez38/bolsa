<?php

use App\Http\Middleware\EsAdministrador;
use App\Http\Middleware\EsOrganizacion;
use App\Http\Middleware\EsUsuario;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => EsAdministrador::class,
            'organizacion' => EsOrganizacion::class,
            'usuario' => EsUsuario::class,
        ]);

        $middleware->redirectGuestsTo('/');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
