@extends('usuario.layouts.app')

@section('title', 'Mi cuenta')

@section('content')

    @include('usuario.components.header')
    @include('usuario.components.leftmenu')

    @php
        $tipoUsuario = $usuario->tipoUsuario?->nombre;
    @endphp

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">
                                Mi perfil
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flat-dashboard-setting flat-dashboard-setting2">
            <div class="themes-container">
                <div class="row">

                    <div class="col-lg-12 col-md-12">

                        <form action="{{ route('usuario.perfil.update') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="profile-setting bg-white">

                                {{-- FOTO DE PERFIL --}}

                                <div class="author-profile flex2 border-bt">
                                    <div class="wrap-img flex2">

                                        <div class="img-box relative" id="profile-preview">

                                            @if ($perfil?->foto)
                                                <img class="avatar" id="profileimg"
                                                    src="{{ asset('storage/' . $perfil->foto) }}" alt="Foto de perfil">
                                            @else
                                                <div class="logo-iniciales">
                                                    {{ strtoupper(substr($usuario->name, 0, 2)) }}
                                                </div>
                                            @endif

                                        </div>

                                        <div id="upload-profile">

                                            <h5 class="fw-6">
                                                Subir una nueva foto:
                                            </h5>

                                            <h6>JPG, JPEG o PNG</h6>

                                            <input class="up-file @error('foto') is-invalid @enderror" id="tf-upload-img"
                                                type="file" name="foto" accept=".jpg,.jpeg,.png">

                                            @error('foto')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>

                                {{-- INFORMACIÓN PERSONAL --}}

                                <div class="form-infor-profile">

                                    <h3 class="title-info">
                                        Información personal
                                    </h3>

                                    <div class="form-infor flex flat-form">

                                        {{-- COLUMNA 1 --}}

                                        <div class="info-box info-wd">

                                            {{-- NOMBRE Y APELLIDO --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Nombre y apellido
                                                </label>

                                                <input type="text" name="name"
                                                    class="input-form @error('name') is-invalid @enderror"
                                                    value="{{ old('name', $usuario->name) }}" maxlength="255" required>

                                                @error('name')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                            {{-- DNI --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    DNI
                                                </label>

                                                <input type="text" class="input-form"
                                                    value="{{ $perfil?->dni ?? 'No disponible' }}" readonly>

                                                <small class="text-muted">
                                                    El DNI no puede modificarse.
                                                </small>
                                            </fieldset>

                                            {{-- CARRERA / ÁREA / DEPARTAMENTO --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Carrera / Área / Departamento
                                                </label>

                                                @if ($tipoUsuario === 'docente')
                                                    <input type="text" name="carrera"
                                                        class="input-form @error('carrera') is-invalid @enderror"
                                                        value="{{ old('carrera', $usuario->carrera ?? '') }}"
                                                        maxlength="255"
                                                        placeholder="Ingresá tu carrera, área o departamento">

                                                    @error('carrera')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                
                                                @else
                                                    <input type="text" class="input-form"
                                                        value="{{ $usuario->personaInstitucional?->nombre ?? 'No disponible' }}"
                                                        readonly>

                                                    <small class="text-muted">
                                                        La carrera institucional no puede modificarse.
                                                    </small>
                                                @endif
                                            </fieldset>

                                            {{-- TELÉFONO --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Teléfono
                                                </label>

                                                <input type="tel" name="telefono"
                                                    class="input-form @error('telefono') is-invalid @enderror"
                                                    value="{{ old('telefono', $perfil?->telefono) }}" maxlength="50">

                                                @error('telefono')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                            {{-- FECHA DE NACIMIENTO --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Fecha de nacimiento
                                                </label>

                                                <input type="date" name="fecha_nacimiento"
                                                    class="input-form @error('fecha_nacimiento') is-invalid @enderror"
                                                    value="{{ old('fecha_nacimiento', $perfil?->fecha_nacimiento?->format('Y-m-d')) }}">

                                                @error('fecha_nacimiento')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                        </div>

                                        {{-- COLUMNA 2 --}}

                                        <div class="info-box info-wd">

                                            {{-- EMAIL --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Email
                                                </label>

                                                <input type="email" class="input-form" value="{{ $usuario->email }}"
                                                    readonly>
                                            </fieldset>

                                            {{-- LEGAJO --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Legajo
                                                </label>

                                                <input type="number" name="legajo" value="{{ $perfil?->legajo ?? '' }}"
                                                    class="input-form" readonly>

                                                <small class="text-muted">
                                                    El legajo no puede modificarse.
                                                </small>
                                            </fieldset>

                                            @if (in_array($tipoUsuario, ['estudiante']))
                                                <fieldset>
                                                    <label class="title-user fw-7">
                                                        Cantidad de materias aprobadas
                                                    </label>

                                                    <input type="text" class="input-form"
                                                        value="{{ $perfil?->materias_aprobadas ?? 'No disponible' }}"
                                                        readonly>

                                                    <small class="text-muted">
                                                        La cantidad de materias aprobadas no puede modificarse.
                                                    </small>
                                                </fieldset>
                                            @endif

                                            {{-- DIRECCIÓN --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Dirección
                                                </label>

                                                <input type="text" name="direccion"
                                                    class="input-form @error('direccion') is-invalid @enderror"
                                                    value="{{ old('direccion', $perfil?->direccion) }}" maxlength="255">

                                                @error('direccion')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                            {{-- LOCALIDAD --}}

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Localidad
                                                </label>

                                                <select name="localidad_id"
                                                    class="input-form @error('localidad_id') is-invalid @enderror">

                                                    <option value="">
                                                        Seleccionar localidad
                                                    </option>

                                                    @foreach ($localidades as $localidad)
                                                        <option value="{{ $localidad->id }}"
                                                            {{ old('localidad_id', $perfil?->localidad_id) == $localidad->id ? 'selected' : '' }}>

                                                            {{ $localidad->nombre }}

                                                        </option>
                                                    @endforeach

                                                </select>

                                                @error('localidad_id')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </fieldset>

                                        </div>

                                    </div>

                                    {{-- SOBRE MÍ --}}

                                    <div class="text-editor-wrap border-bt">

                                        <h3>Sobre mí</h3>

                                        <div class="text-editor-main">

                                            <textarea name="biografia" class="form-control @error('biografia') is-invalid @enderror" rows="8"
                                                placeholder="Contanos brevemente sobre vos, tu experiencia y tus intereses profesionales...">{{ old('biografia', $perfil?->biografia) }}</textarea>

                                            @error('biografia')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>

                                    {{-- REDES PROFESIONALES --}}

                                    <div class="social-wrap border-bt">

                                        <h3>Redes profesionales</h3>

                                        <div class="form-social form-wg flex flat-form">

                                            <div class="form-box info-wd wg-box">

                                                {{-- LINKEDIN --}}

                                                <fieldset class="flex2">
                                                    <span class="icon-linkedin2"></span>

                                                    <input type="url" name="linkedin"
                                                        class="input-form2 @error('linkedin') is-invalid @enderror"
                                                        placeholder="URL de LinkedIn"
                                                        value="{{ old('linkedin', $perfil?->linkedin) }}"
                                                        maxlength="255">
                                                </fieldset>

                                                {{-- GITHUB --}}

                                                <fieldset class="flex2">
                                                    <span class="fa-brands fa-github"></span>

                                                    <input type="url" name="github"
                                                        class="input-form2 @error('github') is-invalid @enderror"
                                                        placeholder="URL de GitHub"
                                                        value="{{ old('github', $perfil?->github) }}" maxlength="255">
                                                </fieldset>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- CURRÍCULUM VITAE --}}

                                    <div class="contact-wrap info-wd">

                                        <h3>Currículum Vitae</h3>

                                        <fieldset class="address-box">

                                            <label class="title-user fw-7">
                                                CV
                                            </label>

                                            <input type="file" name="cv"
                                                class="input-form @error('cv') is-invalid @enderror" accept=".pdf">

                                            @error('cv')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            @if ($perfil?->cv)
                                                <div class="mt-2">

                                                    <section class="flat-dashboard-resumes flat-dashboard-setting">
                                                        <div class="wd-file-apply style2">
                                                            <div class="content">
                                                                <div class="group-seclect-file">
                                                                    <div class="group-file">
                                                                        <div class="inner left">
                                                                            <div class="title-box">

                                                                                <div class="sub-title fs-12 fw-6">
                                                                                    <a href="{{ asset('storage/' . $perfil->cv) }}"
                                                                                        target="_blank">
                                                                                        Ver CV actual
                                                                                    </a>
                                                                                </div>

                                                                                <div class="fs-16 fw-7">
                                                                                    PDF
                                                                                </div>

                                                                            </div>

                                                                            <i class="file-icon icon-file-pdf"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                </div>
                                            @endif

                                        </fieldset>
                                    </div>

                                    {{-- BOTÓN GUARDAR --}}

                                    <hr>

                                    <div class="tt-button button-style right">
                                        <button type="submit" class="btn-3">
                                            Guardar perfil
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

                                <h3 class="title-info">
                                    Seguridad de la cuenta
                                </h3>

                                <div class="contact-wrap info-wd">

                                    <h3>Autenticación en dos pasos</h3>

                                    <p class="mb-3">
                                        Agregá una capa adicional de seguridad a tu cuenta
                                        utilizando Google Authenticator.
                                    </p>

                                    {{-- MENSAJES --}}

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    {{-- 2FA ACTIVADO --}}

                                    @if ($usuario->hasEnabledTwoFactorAuthentication())
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

                                        {{-- 2FA PENDIENTE DE CONFIRMACIÓN --}}
                                    @elseif ($usuario->two_factor_secret)
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

                                        {{-- CÓDIGO QR --}}

                                        <div class="text-center mt-4 mb-4">

                                            <img src="{{ route('usuario.2fa.qr') }}"
                                                alt="Código QR para Google Authenticator"
                                                style="width: 220px; height: 220px;">

                                            <p class="mt-3">
                                                Abrí <strong>Google Authenticator</strong> en tu teléfono
                                                y escaneá este código QR.
                                            </p>

                                        </div>

                                        {{-- CONFIRMAR CÓDIGO --}}

                                        <form action="{{ route('usuario.2fa.confirmar') }}" method="POST">

                                            @csrf

                                            <fieldset>
                                                <label class="title-user fw-7">
                                                    Código de autenticación
                                                </label>

                                                <input type="text" name="code" class="input-form" maxlength="6"
                                                    minlength="6" inputmode="numeric" autocomplete="one-time-code"
                                                    placeholder="Ingresá el código de 6 dígitos" required>

                                                @error('code')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
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
                                                Actualmente tu cuenta utiliza únicamente tu contraseña
                                                para iniciar sesión.
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

    {{-- VISTA PREVIA DE FOTO Y ACTUALIZACIÓN CSRF --}}

    <script>
        /*
                |--------------------------------------------------------------------------
                | Vista previa de foto de perfil
                |--------------------------------------------------------------------------
                */

        const inputFoto = document.getElementById('tf-upload-img');

        if (inputFoto) {
            inputFoto.addEventListener('change', function(event) {

                const archivo = event.target.files[0];

                if (!archivo) {
                    return;
                }

                const preview = document.getElementById('profile-preview');
                const lector = new FileReader();

                lector.onload = function(e) {
                    preview.innerHTML = `
                        <img
                            class="avatar"
                            id="profileimg"
                            src="${e.target.result}"
                            alt="Vista previa de foto de perfil">
                    `;
                };

                lector.readAsDataURL(archivo);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Mantener actualizado el token CSRF
        |--------------------------------------------------------------------------
        */

        function actualizarTokenCSRF() {

            fetch('{{ route('web.csrf') }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('No se pudo actualizar el token CSRF.');
                    }

                    return response.json();
                })
                .then(data => {

                    if (!data.token) {
                        return;
                    }

                    document.querySelectorAll('input[name="_token"]').forEach(function(input) {
                        input.value = data.token;
                    });

                })
                .catch(error => {
                    console.log('No se pudo actualizar el token CSRF:', error);
                });
        }

        /*
        |--------------------------------------------------------------------------
        | Actualizar cada 10 minutos
        |--------------------------------------------------------------------------
        */

        setInterval(actualizarTokenCSRF, 10 * 60 * 1000);
    </script>

@endsection
