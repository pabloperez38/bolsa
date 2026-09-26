<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Bolsa de Trabajo')</title>

    <!-- Font -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/boostrap-select.min.css') }}">

    <!-- Swiper -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/swiper-bundle.min.css') }}">

    <!-- Theme -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/shortcodes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stylesheets/dashboard.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Responsive -->
    <link rel="stylesheet" href="{{ asset('assets/stylesheets/responsive.css') }}">

</head>

<body class="dashboard show ">
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
</body>

</html>
