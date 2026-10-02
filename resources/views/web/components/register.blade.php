<section class="account-section">

    <div class="tf-container">

        <div class="row">

            <div class="wd-form-login tf-tab">

                <h4>Registro de nuevo usuario</h4>

                @if (session('google_register'))
                    <div class="alert alert-info">
                        Estás registrándote con tu cuenta de Google.
                        <br>
                        Correo: <strong>{{ session('google_register.email') }}</strong>
                    </div>
                @endif

                @php
                    $googleRegister = session('google_register');
                @endphp

                {{-- =====================================================
                    TABS
                ====================================================== --}}

                <ul class="menu-tab">
                    <li class="ct-tab active">Candidato</li>
                    <li class="ct-tab">Empresa</li>
                </ul>


                {{-- =====================================================
                    CONTENIDO DE LOS TABS
                ====================================================== --}}

                <div class="content-tab">


                    {{-- =================================================
                        FORMULARIO CANDIDATO
                    ================================================== --}}

                    <div class="inner">

                        <form action="{{ route('registro.candidato') }}" method="POST" id="registerForm">

                            @csrf


                            {{-- =================================================
                                TIPO DE CANDIDATO
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Tipo de usuario<span>*</span>
                                </label>

                                <select name="tipo">

                                    <option value="">
                                        Seleccione una opción
                                    </option>

                                    <option value="estudiante" {{ old('tipo') == 'estudiante' ? 'selected' : '' }}>
                                        Estudiante
                                    </option>

                                    <option value="graduado" {{ old('tipo') == 'graduado' ? 'selected' : '' }}>
                                        Graduado
                                    </option>

                                    <option value="docente" {{ old('tipo') == 'docente' ? 'selected' : '' }}>
                                        Docente
                                    </option>

                                </select>

                                @error('tipo')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                DNI
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    DNI<span>*</span>
                                </label>

                                <input type="text" name="dni" value="{{ old('dni') }}"
                                    placeholder="Ingrese su DNI">

                                @error('dni')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                LEGAJO
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Legajo<span>*</span>
                                </label>

                                <input type="text" name="legajo" value="{{ old('legajo') }}"
                                    placeholder="Ingrese su legajo">

                                @error('legajo')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                EMAIL
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Correo electrónico<span>*</span>
                                </label>

                                <input type="email" name="email"
                                    value="{{ $googleRegister['email'] ?? old('email') }}"
                                    @if ($googleRegister) readonly @endif placeholder="Correo electrónico">

                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                PASSWORD
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input type="password" name="password" class="input-form password-input"
                                        placeholder="Contraseña">

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                CONFIRMAR PASSWORD
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Confirmar contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input type="password" name="password_confirmation"
                                        class="input-form password-input" placeholder="Confirmar contraseña">

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                                @error('password_confirmation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                TÉRMINOS
                            ================================================== --}}

                            <div class="group-ant-choice st">

                                <div class="sub-ip">

                                    <input type="checkbox" name="terminos" value="1"
                                        {{ old('terminos') ? 'checked' : '' }}>

                                    Acepto los

                                    <a href="#">
                                        términos de uso
                                    </a>

                                </div>

                                @error('terminos')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                BOTÓN
                            ================================================== --}}

                            <button type="submit">
                                Registrarme
                            </button>


                            {{-- =================================================
                                LOGIN
                            ================================================== --}}

                            <div class="sign-up">

                                ¿Ya tenés una cuenta?

                                <a href="{{ route('login') }}">
                                    Ingresar
                                </a>

                            </div>

                        </form>

                    </div>



                    {{-- =================================================
                        FORMULARIO EMPRESA
                    ================================================== --}}

                    <div class="inner">

                        <form action="{{ route('registro.empresa') }}" method="POST" id="empresaRegisterForm">

                            @csrf

                            {{-- =================================================
                                RAZÓN SOCIAL
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Razón social / Nombre de empresa<span>*</span>
                                </label>

                                <input type="text" name="razon_social" value="{{ old('razon_social') }}"
                                    placeholder="Nombre de la empresa">

                                @error('razon_social')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                CUIT
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    CUIT<span>*</span>
                                </label>

                                <input type="text" name="cuit" value="{{ old('cuit') }}"
                                    placeholder="Ingrese el CUIT">

                                @error('cuit')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                EMAIL
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Correo electrónico<span>*</span>
                                </label>

                                <input type="email" name="email" value="{{ $googleRegister['email'] ?? old('email') }}" @if($googleRegister) readonly @endif
                                    placeholder="Correo electrónico">

                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                PASSWORD
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input type="password" name="password" class="input-form password-input"
                                        placeholder="Contraseña">

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                                @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                CONFIRMAR PASSWORD
                            ================================================== --}}

                            <div class="ip">

                                <label>
                                    Confirmar contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input type="password" name="password_confirmation"
                                        class="input-form password-input" placeholder="Confirmar contraseña">

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                                @error('password_confirmation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                TÉRMINOS
                            ================================================== --}}

                            <div class="group-ant-choice st">

                                <div class="sub-ip">

                                    <input type="checkbox" name="terminos" value="1"
                                        {{ old('terminos') ? 'checked' : '' }}>

                                    Acepto los

                                    <a href="#">
                                        términos de uso
                                    </a>

                                </div>

                                @error('terminos')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                BOTÓN
                            ================================================== --}}

                            <button type="submit">
                                Registrar empresa
                            </button>


                            {{-- =================================================
                                LOGIN
                            ================================================== --}}

                            <div class="sign-up">

                                ¿Ya tenés una cuenta?

                                <a href="{{ route('login') }}">
                                    Ingresar
                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ============================================================
    ERRORES GENERALES DEL REGISTRO
============================================================ --}}

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Swal.fire({

                icon: 'error',

                title: 'No se pudo completar el registro',

                text: @json(session('error')),

                confirmButtonText: 'Entendido'

            });

        });
    </script>
@endif



{{-- ============================================================
    LOADING AL ENVIAR FORMULARIO
============================================================ --}}

<script>
    const formulariosRegistro = [

        document.getElementById('registerForm'),

        document.getElementById('empresaRegisterForm')

    ];


    formulariosRegistro.forEach(formulario => {

        if (!formulario) {

            return;

        }


        formulario.addEventListener('submit', function() {

            Swal.fire({

                title: 'Creando cuenta...',

                text: 'Estamos registrando tus datos.',

                allowOutsideClick: false,

                allowEscapeKey: false,

                showConfirmButton: false,

                didOpen: () => {

                    Swal.showLoading();

                }

            });

        });

    });
</script>
