@extends('web.layouts.app')

@section('title', 'Autenticación en dos pasos')

@section('content')

    @include('web.components.headersimple')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="profile-setting bg-white mt-5 mb-5">

                    <div class="form-infor-profile">

                        <h3 class="title-info">
                            Autenticación en dos pasos
                        </h3>

                        <div class="contact-wrap info-wd">

                            <p class="mb-4">
                                Para continuar, ingresá el código de
                                <strong>Google Authenticator</strong>.
                                Si no tenés acceso a tu teléfono, podés utilizar
                                uno de tus <strong>códigos de recuperación</strong>.
                            </p>
                            @if ($errors->any())

                                <div class="alert alert-danger">

                                    @foreach ($errors->all() as $error)
                                        <div>
                                            {{ $error }}
                                        </div>
                                    @endforeach

                                </div>

                            @endif

                            <form action="{{ route('usuario.2fa.login.verify') }}" method="POST">

                                @csrf

                                <fieldset>

                                    <label class="title-user fw-7">
                                        Código de autenticación
                                    </label>

                                    <input type="text" name="code" class="input-form" autocomplete="one-time-code"
                                        placeholder="Ingresá tu código de autenticación o recuperación" autofocus required>

                                </fieldset>

                                <div class="tt-button button-style mt-4">

                                    <button type="submit" class="btn-3">
                                        Verificar código
                                    </button>

                                </div>

                            </form>

                            <div class="text-center mt-4">

                                <a href="{{ route('login') }}">
                                    Volver al inicio de sesión
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
