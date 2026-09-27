@extends('web.layouts.app')

@section('title', 'Inicio de sesión')

@section('content')

    @include('web.components.headersimple')

    <section class="bg-f5">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title">
                        <div class="widget-menu-link">
                            <ul>
                                <li><a href="/">Inicio</a></li>
                                <li><a href="/register">Registro</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.components.register')

@endsection
