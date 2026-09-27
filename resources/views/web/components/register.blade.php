<section class="account-section">
    <div class="tf-container">
        <div class="row">

            <div class="wd-form-login tf-tab">

                <h4>Registro de nuevo usuario</h4>

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

                        <form action="{{ route('registro.candidato') }}" method="POST">

                            @csrf

                            {{-- Tipo de candidato --}}
                            <div class="ip">

                                <label>
                                    Tipo de usuario<span>*</span>
                                </label>

                                <select name="tipo" required>

                                    <option value="">
                                        Seleccione una opción
                                    </option>

                                    <option value="estudiante">
                                        Estudiante
                                    </option>

                                    <option value="graduado">
                                        Graduado
                                    </option>

                                    <option value="docente">
                                        Docente
                                    </option>

                                </select>

                            </div>


                            {{-- DNI --}}
                            <div class="ip">

                                <label>
                                    DNI<span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="dni"
                                    value="{{ old('dni') }}"
                                    placeholder="Ingrese su DNI"
                                    required
                                >

                            </div>


                            {{-- Legajo --}}
                            <div class="ip">

                                <label>
                                    Legajo<span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="legajo"
                                    value="{{ old('legajo') }}"
                                    placeholder="Ingrese su legajo"
                                    required
                                >

                            </div>


                            {{-- Email --}}
                            <div class="ip">

                                <label>
                                    Correo electrónico<span>*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Correo electrónico"
                                    required
                                >

                            </div>


                            {{-- Password --}}
                            <div class="ip">

                                <label>
                                    Contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input
                                        type="password"
                                        name="password"
                                        class="input-form password-input"
                                        placeholder="Contraseña"
                                        required
                                    >

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                            </div>


                            {{-- Confirmación --}}
                            <div class="ip">

                                <label>
                                    Confirmar contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="input-form password-input"
                                        placeholder="Confirmar contraseña"
                                        required
                                    >

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                            </div>


                            {{-- Términos --}}
                            <div class="group-ant-choice st">

                                <div class="sub-ip">

                                    <input
                                        type="checkbox"
                                        name="terminos"
                                        value="1"
                                        required
                                    >

                                    Acepto los
                                    <a href="#">
                                        términos de uso
                                    </a>

                                </div>

                            </div>

                            <button type="submit">
                                Registrarme
                            </button>


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

                        <form action="{{ route('registro.empresa') }}" method="POST">

                            @csrf

                            {{-- Razón social --}}
                            <div class="ip">

                                <label>
                                    Razón social / Nombre de empresa<span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="razon_social"
                                    value="{{ old('razon_social') }}"
                                    placeholder="Nombre de la empresa"
                                    required
                                >

                            </div>


                            {{-- CUIT --}}
                            <div class="ip">

                                <label>
                                    CUIT<span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="cuit"
                                    value="{{ old('cuit') }}"
                                    placeholder="Ingrese el CUIT"
                                    required
                                >

                            </div>


                            {{-- Email --}}
                            <div class="ip">

                                <label>
                                    Correo electrónico<span>*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Correo electrónico"
                                    required
                                >

                            </div>


                            {{-- Password --}}
                            <div class="ip">

                                <label>
                                    Contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input
                                        type="password"
                                        name="password"
                                        class="input-form password-input"
                                        placeholder="Contraseña"
                                        required
                                    >

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                            </div>


                            {{-- Confirmación --}}
                            <div class="ip">

                                <label>
                                    Confirmar contraseña<span>*</span>
                                </label>

                                <div class="inputs-group auth-pass-inputgroup">

                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="input-form password-input"
                                        placeholder="Confirmar contraseña"
                                        required
                                    >

                                    <a class="icon-eye-off password-addon"></a>

                                </div>

                            </div>


                            {{-- Términos --}}
                            <div class="group-ant-choice st">

                                <div class="sub-ip">

                                    <input
                                        type="checkbox"
                                        name="terminos"
                                        value="1"
                                        required
                                    >

                                    Acepto los
                                    <a href="#">
                                        términos de uso
                                    </a>

                                </div>

                            </div>


                            <button type="submit">
                                Registrar empresa
                            </button>


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
