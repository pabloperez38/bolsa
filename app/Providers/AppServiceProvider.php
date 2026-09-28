<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Categoria;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('web.*', function ($view) {

            $categorias = Categoria::with([
                'subcategorias' => function ($query) {
                    $query->where('activo', true)
                        ->orderBy('nombre');
                }
            ])
                ->where('activo', true)
                ->orderBy('nombre')
                ->get();

            $view->with('categorias', $categorias);
        });

        Paginator::useBootstrapFive();
    }
}
