@extends('web.layouts.app')

@section('title', 'Sesión expirada')

@section('content')

    <div class="container py-5">

        <div class="text-center">

            <h1>419</h1>

            <h2>Sesión expirada</h2>

            <p>
                La página ha expirado o la sesión ya no es válida.
            </p>

            <a href="{{ route('login') }}" class="tf-btn">
                Volver al inicio de sesión
            </a>

        </div>

    </div>

@endsection