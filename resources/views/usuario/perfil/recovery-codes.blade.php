@extends('usuario.layouts.app')

@section('title', 'Mi cuenta')

@section('content')

    @include('usuario.components.header')

    @include('usuario.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">
                                Códigos de recuperación
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flat-dashboard-setting flat-dashboard-setting2">

            <section class="themes-container">

                <div class="row">

                    <div class="col-lg-12 col-md-12">

                        <div class="profile-setting bg-white mt-4">

                            <div class="form-infor-profile">

                                <div class="contact-wrap info-wd">

                                    <div class="alert alert-warning">
                                        <strong>
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            Importante
                                        </strong>

                                        <p class="mb-0 mt-2">
                                            Estos códigos te permiten acceder a tu cuenta si perdés
                                            el teléfono donde utilizás Google Authenticator.
                                        </p>
                                    </div>

                                    <p>
                                        Cada código puede utilizarse <strong>una sola vez</strong>.
                                        Guardalos en un lugar seguro.
                                    </p>

                                    <div class="mt-4">

                                        @foreach ($usuario->recoveryCodes() as $code)
                                            <div class="border rounded p-2 mb-2 text-center">
                                                <strong>{{ $code }}</strong>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="alert alert-danger mt-4">
                                        <strong>
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            Atención
                                        </strong>

                                        <p class="mb-0 mt-2">
                                            Si regenerás los códigos, los códigos actuales dejarán de ser válidos.
                                            Se generará un nuevo conjunto de códigos de recuperación.
                                        </p>
                                    </div>

                                    <form id="form-regenerar-codigos"
                                        action="{{ route('usuario.2fa.recovery-codes.regenerate') }}" method="POST"
                                        class="mt-3">
                                        @csrf

                                        <div class="tt-button button-style">
                                            <button type="submit" class="btn-2">
                                                <i class="fa-solid fa-rotate"></i>
                                                Regenerar códigos de recuperación
                                            </button>
                                        </div>
                                    </form>

                                    <div class="mt-4">
                                        <a href="{{ route('usuario.perfil') }}" class="btn-3">
                                            Volver al perfil
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </section>

        </section>

    </div>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Códigos regenerados',
                    text: @json(session('success')),
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const formulario = document.getElementById('form-regenerar-codigos');

            if (formulario) {

                formulario.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        icon: 'warning',
                        title: '¿Regenerar códigos?',
                        text: 'Los códigos actuales dejarán de funcionar y se generará un nuevo conjunto de códigos.',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, regenerar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {

                        if (result.isConfirmed) {
                            formulario.submit();
                        }

                    });

                });

            }

        });
    </script>
@endsection
