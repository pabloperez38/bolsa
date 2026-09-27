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

                                            <h6>
                                                JPG, JPEG o PNG
                                            </h6>

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


                                {{-- ==========================================
                                 INFORMACIÓN PERSONAL
                            =========================================== --}}

                                <div class="form-infor-profile">

                                    <h3 class="title-info">
                                        Información personal
                                    </h3>

                                    <div class="form-infor flex flat-form">

                                        {{-- COLUMNA 1 --}}

                                        <div class="info-box info-wd">

                                            {{-- Nombre y apellido --}}

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

                                                <input type="text" name="dni" class="input-form"
                                                    value="{{ $perfil->dni }}" readonly>

                                                <small class="text-muted">
                                                    El DNI no puede modificarse.
                                                </small>

                                            </fieldset>


                                            {{-- Teléfono --}}

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


                                            {{-- Fecha de nacimiento --}}

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


                                            {{-- Email --}}

                                            <fieldset>

                                                <label class="title-user fw-7">
                                                    Email
                                                </label>

                                                <input type="email" class="input-form" value="{{ $usuario->email }}"
                                                    readonly>

                                            </fieldset>


                                            {{-- Legajo --}}

                                            <fieldset>

                                                <label class="title-user fw-7">
                                                    Legajo
                                                </label>

                                                <input type="number" name="legajo" value="{{ $perfil->legajo }}"
                                                    class="input-form" readonly>

                                                <small class="text-muted">
                                                    El legajo no puede modificarse.
                                                </small>

                                            </fieldset>

                                            {{-- Dirección --}}

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


                                            {{-- Localidad --}}

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


                                    {{-- ==========================================
                                     SOBRE MÍ
                                =========================================== --}}

                                    <div class="text-editor-wrap border-bt">

                                        <h3>
                                            Sobre mí
                                        </h3>

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


                                    {{-- ==========================================
                                     REDES PROFESIONALES
                                =========================================== --}}

                                    <div class="social-wrap border-bt">

                                        <h3>
                                            Redes profesionales
                                        </h3>

                                        <div class="form-social form-wg flex flat-form">

                                            <div class="form-box info-wd wg-box">

                                                {{-- LinkedIn --}}

                                                <fieldset class="flex2">

                                                    <span class="icon-linkedin2"></span>

                                                    <input type="url" name="linkedin"
                                                        class="input-form2 @error('linkedin') is-invalid @enderror"
                                                        placeholder="URL de LinkedIn"
                                                        value="{{ old('linkedin', $perfil?->linkedin) }}"
                                                        maxlength="255">

                                                </fieldset>

                                                @error('linkedin')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>

                                        </div>

                                    </div>


                                    {{-- ==========================================
                                     CURRÍCULUM VITAE
                                =========================================== --}}

                                    <div class="contact-wrap info-wd">

                                        <h3>
                                            Currículum Vitae
                                        </h3>

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
                                                                        <div class="inner left ">
                                                                            <div class="title-box">
                                                                                <div class="sub-title fs-12 fw-6">
                                                                                    <a href="{{ asset('storage/' . $perfil->cv) }}"
                                                                                        target="_blank">
                                                                                        Ver CV actual
                                                                                    </a>
                                                                                </div>
                                                                                <div class="fs-16 fw-7">PDF</div>
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

                                    {{-- Botón guardar --}}

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

                </div>

            </div>

        </section>

    </div>
    <script>
        document.getElementById('tf-upload-img').addEventListener('change', function(event) {

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
    </script>
@endsection
