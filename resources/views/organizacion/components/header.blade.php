<header id="header" class="header header-default ">
    <div class="tf-container ct2">
        <div class="row">
            <div class="col-md-12">
                <div class="sticky-area-wrap">
                    <div class="header-ct-left">
                        <div id="logo" class="logo">
                            <a href="../home-01.html">
                                <img class="site-logo" src="../images/logo.png" alt="Image" />

                            </a>
                        </div>

                    </div>

                    <div class="header-ct-right">
                        <div class="header-customize-item help">
                            <a href="../term-of-use.html"><span class="icon-help-circle"></span></a>
                        </div>
                        <div class="header-customize-item bell">
                            <span class="icon-bell"></span>
                            <div class="sub-notification">
                                <div class="sub-notification-heading">
                                    <div class="sub-notification-title">Notification</div>
                                    <span>5 New</span>
                                </div>
                                <div class="sub-notification-content">
                                    <div class="sub-notification-item icon-plus">
                                        <div class="time">Last day</div>
                                        <div class="content">
                                            Your submit job <span class="name">Graphic Design</span> is
                                            <span class="status">Success</span>
                                        </div>
                                    </div>
                                    <div class="sub-notification-item icon-plus">
                                        <div class="time">5 Day ago</div>
                                        <div class="content">
                                            A new application is submitted on your job
                                            <span class="name">Graphic Design</span> by
                                            <span class="name">Maverick Nguyen</span>
                                        </div>
                                    </div>
                                    <div class="sub-notification-item icon-plus">
                                        <div class="time">5 Day ago</div>
                                        <div class="content">
                                            A new application is submitted on your job
                                            <span class="name">Graphic Design</span> by
                                            <span class="name">Maverick Nguyen</span>
                                        </div>
                                    </div>
                                    <div class="sub-notification-item icon-plus">
                                        <div class="time">Last day</div>
                                        <div class="content">
                                            Your submit job <span class="name">Graphic Design</span> is
                                            <span class="status">Success</span>
                                        </div>
                                    </div>
                                    <div class="sub-notification-item icon-plus">
                                        <div class="time">5 Day ago</div>
                                        <div class="content">
                                            A new application is submitted on your job
                                            <span class="name">Graphic Design</span> by
                                            <span class="name">Maverick Nguyen</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-notification-button">
                                    <a href="#">Read All</a>
                                </div>
                            </div>
                        </div>
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
