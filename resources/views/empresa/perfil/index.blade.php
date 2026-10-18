@extends('empresa.layouts.app')

@section('title', config('app.name') . ' - Mi Empresa')

@section('content')

    @include('empresa.components.header')
    @include('empresa.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">
                                Mi empresa
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flat-dashboard-setting flat-dashboard-setting2">
            <div class="themes-container">
                <div class="row">

                    {{-- PERFIL DE LA EMPRESA --}}
                    <div class="col-lg-12 col-md-12">                  

                        <form action="{{ route('empresa.perfil.update') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="profile-setting bg-white">

                                {{-- LOGO --}}
                                <div class="author-profile flex2 border-bt">
                                    <div class="wrap-img flex2">

                                        <div class="img-box relative" id="profile-preview">

                                            @if ($empresa?->logo)
                                                <img class="avatar" id="profileimg"
                                                    src="{{ asset('storage/' . $empresa->logo) }}"
                                                    alt="Logo de {{ $empresa->nombre }}">
                                            @else
                                                <div class="logo-iniciales">
                                                    {{ strtoupper(substr($empresa?->nombre ?? 'EM', 0, 2)) }}
                                                </div>
                                            @endif

                                        </div>

                                        <div id="upload-profile">
                                            <h5 class="fw-6">Logo de la empresa</h5>
                                            <h6>Formatos permitidos: JPG, JPEG o PNG</h6>

                                            <input class="up-file @error('logo') is-invalid @enderror" id="tf-upload-img"
                                                type="file" name="logo" accept=".jpg,.jpeg,.png">

                                            @error('logo')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                {{-- DATOS GENERALES --}}
                                <div class="form-infor-profile">

                                    <h3 class="title-info">Datos de la empresa</h3>

                                    <div class="form-infor flex flat-form">

                                        {{-- COLUMNA 1 --}}
                                        <div class="info-box info-wd">

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Nombre de la empresa
                                                </label>

                                                <input type="text" name="nombre"
                                                    class="input-form @error('nombre') is-invalid @enderror"
                                                    value="{{ old('nombre', $empresa?->nombre) }}" maxlength="150" required>

                                                @error('nombre')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                            <fieldset>
                                                <label class="title-user fw-7">CUIT</label>

                                                <input type="text" name="cuit"
                                                    class="input-form @error('cuit') is-invalid @enderror"
                                                    value="{{ old('cuit', $empresa?->cuit) }}" maxlength="20" required>

                                                @error('cuit')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                            <fieldset>
                                                <label class="title-user fw-7">Email de contacto</label>

                                                <input type="email" name="email"
                                                    class="input-form @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $empresa?->email) }}" maxlength="150" required>

                                                @error('email')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                            <fieldset>
                                                <label class="title-user fw-7">Teléfono</label>

                                                <input type="tel" name="telefono"
                                                    class="input-form @error('telefono') is-invalid @enderror"
                                                    value="{{ old('telefono', $empresa?->telefono) }}" maxlength="50">

                                                @error('telefono')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                        </div>

                                        {{-- COLUMNA 2 --}}
                                        <div class="info-box info-wd">

                                            <fieldset>
                                                <label class="title-user fw-7">Sitio web</label>

                                                <input type="url" name="sitio_web"
                                                    class="input-form @error('sitio_web') is-invalid @enderror"
                                                    value="{{ old('sitio_web', $empresa?->sitio_web) }}" maxlength="255"
                                                    placeholder="https://www.ejemplo.com">

                                                @error('sitio_web')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                            <fieldset>
                                                <label class="title-user fw-7">Dirección</label>

                                                <input type="text" name="direccion"
                                                    class="input-form @error('direccion') is-invalid @enderror"
                                                    value="{{ old('direccion', $empresa?->direccion) }}" maxlength="255">

                                                @error('direccion')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>


                                            {{-- PROVINCIA --}}
                                            <fieldset>
                                                <label class="title-user fw-7" for="provincia_id">
                                                    Provincia
                                                </label>

                                                <select id="provincia_id" name="provincia_id"
                                                    class="input-form @error('provincia_id') is-invalid @enderror" required>
                                                    <option value="">Seleccioná una provincia</option>

                                                    @foreach ($provincias as $provincia)
                                                        <option value="{{ $provincia->id }}" @selected((string) old('provincia_id', $provinciaSeleccionada) === (string) $provincia->id)>
                                                            {{ $provincia->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('provincia_id')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </fieldset>

                                            {{-- LOCALIDAD --}}
                                            <fieldset>
                                                <label class="title-user fw-7" for="localidad_id">
                                                    Localidad
                                                </label>

                                                <select id="localidad_id" name="localidad_id"
                                                    class="input-form @error('localidad_id') is-invalid @enderror" required
                                                    disabled>
                                                    <option value="">Primero seleccioná una provincia</option>
                                                </select>

                                                @error('localidad_id')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </fieldset>

                                        </div>
                                    </div>

                                    {{-- DESCRIPCIÓN --}}
                                    <div class="text-editor-wrap border-bt">

                                        <h3>Descripción de la empresa</h3>

                                        <div class="text-editor-main">
                                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="6"
                                                maxlength="255" placeholder="Contá brevemente a qué se dedica la empresa...">{{ old('descripcion', $empresa?->descripcion) }}</textarea>

                                            @error('descripcion')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- ACCESO A LA CUENTA --}}
                                    <div class="text-editor-wrap border-bt mt-4">

                                        <h3 class="title-info">Acceso a la cuenta</h3>

                                        <p>
                                            Este correo y contraseña se utilizan para iniciar sesión.
                                            Son independientes de los datos de contacto de la empresa.
                                        </p>

                                        {{-- EMAIL DE ACCESO --}}
                                        <fieldset>
                                            <label for="email_acceso" class="title-user fw-7">
                                                Correo de inicio de sesión
                                            </label>

                                            <input type="email" id="email_acceso" name="email_acceso"
                                                class="input-form @error('email_acceso') is-invalid @enderror"
                                                value="{{ old('email_acceso', auth()->user()->email) }}" maxlength="255"
                                                autocomplete="username" required>

                                            @error('email_acceso')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </fieldset>

                                        <hr>

                                        <h4>Cambiar contraseña</h4>

                                        <p>
                                            Si no querés cambiarla, dejá estos campos vacíos.
                                        </p>

                                        {{-- CONTRASEÑA ACTUAL --}}
                                        <fieldset>
                                            <label for="password_actual" class="title-user fw-7">
                                                Contraseña actual
                                            </label>

                                            <input type="password" id="password_actual" name="password_actual"
                                                class="input-form @error('password_actual') is-invalid @enderror"
                                                autocomplete="current-password">

                                            @error('password_actual')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </fieldset>

                                        {{-- NUEVA CONTRASEÑA --}}
                                        <fieldset>
                                            <label for="password" class="title-user fw-7">
                                                Nueva contraseña
                                            </label>

                                            <input type="password" id="password" name="password"
                                                class="input-form @error('password') is-invalid @enderror" minlength="8"
                                                autocomplete="new-password">

                                            @error('password')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </fieldset>

                                        {{-- CONFIRMAR CONTRASEÑA --}}
                                        <fieldset>
                                            <label for="password_confirmation" class="title-user fw-7">
                                                Confirmar nueva contraseña
                                            </label>

                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" class="input-form" minlength="8"
                                                autocomplete="new-password">
                                        </fieldset>

                                    </div>


                                    {{-- GUARDAR --}}

                                    <div class="tt-button button-style right">
                                        <button type="submit" class="btn-3">
                                            Guardar datos de la empresa
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>

                    {{-- SEGURIDAD DE LA CUENTA --}}
                    <div class="col-md-12">

                        <div class="profile-setting bg-white mt-4">

                            <div class="form-infor-profile">

                                <h3 class="title-info">Seguridad de la cuenta</h3>

                                <div class="contact-wrap info-wd">

                                    <h3>Autenticación en dos pasos</h3>

                                    <p class="mb-3">
                                        Agregá una capa adicional de seguridad a tu cuenta
                                        utilizando Google Authenticator.
                                    </p>

                                    {{-- 2FA ACTIVADO --}}
                                    @if (auth()->user()->hasEnabledTwoFactorAuthentication())
                                        <div class="alert alert-success">
                                            <strong>
                                                <i class="fa-solid fa-shield-halved"></i>
                                                Autenticación en dos pasos activada
                                            </strong>

                                            <p class="mb-0 mt-2">
                                                Tu cuenta está protegida mediante autenticación
                                                en dos pasos.
                                            </p>
                                        </div>

                                        <form action="{{ route('usuario.2fa.disable') }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div class="tt-button button-style">
                                                <button type="submit" class="btn-2">
                                                    Desactivar autenticación en dos pasos
                                                </button>
                                            </div>
                                        </form>

                                        <div class="tt-button button-style mt-3">
                                            <a href="{{ route('usuario.2fa.recovery-codes') }}" class="btn-3">
                                                Ver códigos de recuperación
                                            </a>
                                        </div>

                                        {{-- 2FA PENDIENTE --}}
                                    @elseif (auth()->user()->two_factor_secret)
                                        <div class="alert alert-warning">
                                            <strong>
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                Configuración pendiente
                                            </strong>

                                            <p class="mb-0 mt-2">
                                                Escaneá el código QR con Google Authenticator
                                                y luego ingresá el código de 6 dígitos para
                                                confirmar la configuración.
                                            </p>
                                        </div>

                                        <div class="text-center mt-4 mb-4">
                                            <img src="{{ route('usuario.2fa.qr') }}"
                                                alt="Código QR para Google Authenticator"
                                                style="width: 220px; height: 220px;">

                                            <p class="mt-3">
                                                Abrí <strong>Google Authenticator</strong> en tu teléfono
                                                y escaneá este código QR.
                                            </p>
                                        </div>

                                        <form action="{{ route('usuario.2fa.confirmar') }}" method="POST">
                                            @csrf

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Código de autenticación
                                                </label>

                                                <input type="text" name="code"
                                                    class="input-form @error('code') is-invalid @enderror" maxlength="6"
                                                    minlength="6" inputmode="numeric" autocomplete="one-time-code"
                                                    placeholder="Ingresá el código de 6 dígitos" required>

                                                @error('code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </fieldset>

                                            <div class="tt-button button-style mt-3">
                                                <button type="submit" class="btn-3">
                                                    Confirmar y activar 2FA
                                                </button>
                                            </div>
                                        </form>

                                        {{-- 2FA DESACTIVADO --}}
                                    @else
                                        <div class="alert alert-light border">
                                            <strong>
                                                <i class="fa-solid fa-shield-halved"></i>
                                                Autenticación en dos pasos desactivada
                                            </strong>

                                            <p class="mb-0 mt-2">
                                                Actualmente tu cuenta utiliza únicamente
                                                su contraseña para iniciar sesión.
                                            </p>
                                        </div>

                                        <div class="tt-button button-style">
                                            <form action="{{ route('usuario.2fa.enable') }}" method="POST">
                                                @csrf

                                                <button type="submit" class="btn-3">
                                                    Activar autenticación en dos pasos
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinciaSelect = document.getElementById('provincia_id');
            const localidadSelect = document.getElementById('localidad_id');

            const localidades =
                {{ Js::from(
                    $localidades->map(
                            fn($localidad) => [
                                'id' => $localidad->id,
                                'provincia_id' => $localidad->provincia_id,
                                'nombre' => $localidad->nombre,
                            ],
                        )->values(),
                ) }};

            // Conservar la localidad seleccionada al abrir el perfil
            // o cuando Laravel devuelve errores de validación.
            const localidadInicial = @json((string) old('localidad_id', $empresa?->localidad_id ?? ''));

            function cargarLocalidades(provinciaId, localidadSeleccionada = '') {
                localidadSelect.innerHTML = '';

                const opcionInicial = document.createElement('option');
                opcionInicial.value = '';
                opcionInicial.textContent = provinciaId ?
                    'Seleccioná una localidad' :
                    'Primero seleccioná una provincia';

                localidadSelect.appendChild(opcionInicial);

                if (!provinciaId) {
                    localidadSelect.disabled = true;
                    return;
                }

                const filtradas = localidades.filter(function(localidad) {
                    return String(localidad.provincia_id) === String(provinciaId);
                });

                filtradas.forEach(function(localidad) {
                    const opcion = document.createElement('option');

                    opcion.value = localidad.id;
                    opcion.textContent = localidad.nombre;

                    if (String(localidad.id) === String(localidadSeleccionada)) {
                        opcion.selected = true;
                    }

                    localidadSelect.appendChild(opcion);
                });

                localidadSelect.disabled = filtradas.length === 0;

                if (filtradas.length === 0) {
                    opcionInicial.textContent = 'No hay localidades disponibles';
                }
            }

            provinciaSelect.addEventListener('change', function() {
                // Al cambiar de provincia, se reinicia la localidad.
                cargarLocalidades(this.value);
            });

            // Cargar la localidad existente al abrir el perfil.
            cargarLocalidades(provinciaSelect.value, localidadInicial);
        });
    </script>

@endsection
