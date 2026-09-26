@extends('web.layouts.app')

@section('title', 'Acceso no autorizado')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="text-center py-5">

                    <h1 class="display-1 fw-bold">403</h1>

                    <h2 class="mb-3">
                        Acceso no autorizado
                    </h2>

                    <p class="text-muted mb-4">
                        No tenés permisos para acceder a esta sección.
                    </p>

                    @auth

                        @php
                            $tipo = auth()->user()->tipoUsuario->nombre;
                        @endphp

                        @if ($tipo === 'administrador')
                            <a href="{{ route('admin.index') }}" class="btn btn-primary">
                                Volver al panel de administración
                            </a>
                        @elseif ($tipo === 'Empresa')
                            <a href="{{ route('Empresa.index') }}" class="btn btn-primary">
                                Volver al panel de organización
                            </a>
                        @elseif (in_array($tipo, ['estudiante', 'graduado', 'personal']))
                            <a href="{{ route('usuario.index') }}" class="btn btn-primary">
                                Volver a mi cuenta
                            </a>
                        @else
                            <a href="{{ route('web.index') }}" class="btn btn-primary">
                                Volver al inicio
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Iniciar sesión
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

@endsection
