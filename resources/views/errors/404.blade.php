@extends('web.layouts.app')

@section('title', 'Página no encontrada')

@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 70vh;">

            <div class="col-md-8 col-lg-6 text-center">

                {{-- Número de error --}}
                <div class="mb-4">
                    <h1 class="display-1 fw-bold text-primary" style="font-size: 8rem;">
                        404
                    </h1>
                </div>

                {{-- Título --}}
                <h2 class="fw-bold mb-3">
                    ¡Ups! Página no encontrada
                </h2>

                {{-- Descripción --}}
                <p class="text-muted fs-5 mb-4">
                    La página que estás buscando no existe, fue movida
                    o ya no se encuentra disponible.
                </p>

                {{-- Botones --}}
                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <a href="{{ route('web.index') }}" class="btn btn-primary px-4">
                        <i class="fas fa-home me-2"></i>
                        Volver al inicio
                    </a>

                    <button type="button" class="btn btn-outline-secondary px-4" onclick="history.back()">
                        <i class="fas fa-arrow-left me-2"></i>
                        Volver atrás
                    </button>

                </div>

            </div>

        </div>
    </div>

@endsection
