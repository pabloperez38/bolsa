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


    <div class="menu-mobile-popup">
        <div class="modal-menu__backdrop"></div>
        <div class="widget-filter">

            <div class="mobile-header">
                <div id="logo" class="logo">
                    <a href="../home-01.html
">
                        <img class="site-logo" src="../images/logo.png" alt="Image" />
                    </a>
                </div>
                <a class="title-button-group"><i class="icon-close"></i></a>

            </div>        

            <div class="mobile-footer">
                <div class="icon-infor d-flex aln-center">
                    <div class="icon">
                        <span class="icon-call-calling"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span><span class="path4"></span></span>
                    </div>
                    <div class="content">
                        <p>Need help? 24/7</p>
                        <h6><a href="tel:0123456678">001-1234-88888</a></h6>
                    </div>
                </div>
                <div class="wd-social d-flex aln-center">
                    <ul class="list-social d-flex aln-center">
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#"><i class="icon-instagram1"></i></a></li>
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    @yield('content')


    <script src="{{ asset('assets/javascript/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/swiper-bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
