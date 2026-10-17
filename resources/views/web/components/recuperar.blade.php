<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="wd-form-login">

                <h4>Recuperar contraseña</h4>

                <p class="mb-3">
                    Ingresá el correo electrónico asociado a tu cuenta.
                    Te enviaremos un enlace para renovar tu contraseña.
                </p>

                {{-- Mensaje de éxito --}}
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('password.email') }}"
                    method="POST"
                    id="forgotPasswordForm"
                >
                    @csrf

                    <div class="ip">
                        <label>
                            Email<span>*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="Ingresá tu correo electrónico"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                        >

                        @error('email')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="ip">
                        <button type="submit">
                            Enviar enlace de recuperación
                        </button>
                    </div>

                    <div class="group-ant-choice">
                        <a href="{{ route('login') }}" class="forgot">
                            Volver al inicio de sesión
                        </a>
                    </div>

                    <p class="line-ip">
                        <span>¿Todavía no tenés una cuenta?</span>
                    </p>

                    <div class="sign-up">
                        <a href="{{ route('register') }}">
                            Registrarme
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

<script>
    document
        .getElementById('forgotPasswordForm')
        .addEventListener('submit', function () {

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Procesando solicitud...',
                    text: 'Estamos preparando la recuperación de tu contraseña.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });
</script>
