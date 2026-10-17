<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bolsa de Trabajo')</title>

    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/boostrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/shortcodes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
</head>

<body class="dashboard show">
    <a id="scroll-top"></a>

    @yield('content')

    <script src="{{ asset('assets/javascript/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/boostrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/countto.js') }}"></script>
    <script src="{{ asset('assets/javascript/wow.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/password-addon.js') }}"></script>
    <script src="{{ asset('assets/javascript/swiper.js') }}"></script>
    <script src="{{ asset('assets/javascript/plugin.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/javascript/main.js') }}"></script>
    <script src="{{ asset('assets/javascript/dashboard-menu.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/dashboard-menu.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: @json(session('success')),
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: @json($errors->first()),
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: @json(session('error')),
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perfil incompleto',
                    text: @json(session('warning')),
                    showConfirmButton: true,
                    confirmButtonText: 'Completar perfil'
                });
            });
        </script>
    @endif
    @if (session('status') === \Laravel\Fortify\Fortify::TWO_FACTOR_AUTHENTICATION_DISABLED)
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                Swal.fire({
                    icon: 'success',
                    title: '2FA desactivado',
                    text: 'La autenticación en dos pasos fue quitada correctamente.',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.form-retirar-postulacion').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Si te retirás, se eliminará tu postulación y no podrás deshacer esta acción.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, retirarme',
                        cancelButtonText: 'Cancelar'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
