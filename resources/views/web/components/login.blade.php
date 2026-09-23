<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="wd-form-login">
                <h4>Ingreso de usuario</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">

                    @csrf
                    <div class="ip">
                        <label>Email<span>*</span></label>
                        <input type="email" name="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="ip">
                        <label>Password<span>*</span></label>
                        <div class="inputs-group auth-pass-inputgroup">

                            <input type="password"
                                class="input-form password-input @error('password') is-invalid @enderror"
                                placeholder="Contraseña" id="password-input" name="password">

                            <a class="icon-eye-off password-addon" id="password-addon">
                            </a>

                        </div>

                        @error('password')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="group-ant-choice">
                        <div class="sub-ip"><input type="checkbox" name="remember" id="remember">Recordarme</div>
                        <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
                    </div>
                    <p class="line-ip"><span>o ingrese con redes sociales</span></p>
                    <a href="#" class="btn-social">Continuar con Facebook</a>
                    <a href="#" class="btn-social"> Continuar con Google</a>

                    <button type="submit">Ingresar</button>
                    <div class="sign-up">Todavía no estás registrado? <a href="#">Registrarme</a></div>
                </form>
            </div>
        </div>
    </div>
</section>
