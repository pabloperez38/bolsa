<header id="header" class="header header-default ">
    <div class="tf-container ct2">
        <div class="row">
            <div class="col-md-12">
                <div class="sticky-area-wrap">
                    <div class="header-ct-left">
                        <div id="logo" class="logo">
                            <a href="/">
                              <img class="site-logo" src="{{ asset('assets/img/logo-2.png') }}"
                                     alt="Logo">

                            </a>
                        </div>

                    </div>

                    <div class="header-ct-right">
                       
                    
                        <div class="header-customize-item account">

                            <div class="name">
                                Bienvenido, {{ Auth::user()->name }} <b>({{ Auth::user()->tipoUsuario->nombre }})</b>
                            </div>
                          
                        </div>
                       
                    </div>
                    <div class="nav-filter">
                        <div class="nav-mobile"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="btn header-item " id="left-menu-btn">
        <span class="hamburger-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </div>
</header>
