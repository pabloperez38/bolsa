@extends('web.layouts.app')

@section('title', config('app.name') . ' - Renovar contraseña')

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
                                <li><a href="/login">Renovar contraseña</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="account-section">
        <div class="tf-container">
            <div class="row">
                <div class="wd-form-login">
                    <h4>Renovar contraseña</h4>

                    <p class="mb-3">
                        Ingresá tu nueva contraseña y confirmala
                        para recuperar el acceso a tu cuenta.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST" id="resetPasswordForm">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="ip">
                            <label>Email<span>*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $email) }}" placeholder="Correo electrónico" required
                                autocomplete="email">
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="ip">
                            <label>Nueva contraseña<span>*</span></label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Nueva contraseña"
                                required autocomplete="new-password">
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="ip">
                            <label>Confirmar contraseña<span>*</span></label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Repetí la nueva contraseña" required autocomplete="new-password">
                        </div>

                        <div class="ip">
                            <button type="submit">
                                Guardar nueva contraseña
                            </button>
                        </div>

                        <div class="group-ant-choice">
                            <a href="{{ route('login') }}" class="forgot">
                                Volver al inicio de sesión
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document
            .getElementById('resetPasswordForm')
            .addEventListener('submit', function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Actualizando contraseña...',
                        text: 'Estamos guardando los cambios.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => Swal.showLoading()
                    });
                }
            });
    </script>

    @include('web.components.footer')

@endsection
