 <div class="menu-mobile-popup">
     <div class="modal-menu__backdrop"></div>
     <div class="widget-filter">
         <div class="mobile-header">
             <div id="logo" class="logo">
                 <a href="/
">
                     <img class="site-logo" src="{{ asset('assets/img/logo-2.png') }}" alt="Logo">
                 </a>
             </div>
             <a class="title-button-group"><i class="icon-close"></i></a>
         </div>

         <div class="tf-tab">
             <div class="menu-tab">
                 <div class="user-tag active">Menú</div>
                 <div class="user-tag">Categorías</div>
             </div>

             <div class="content-tab">
                 <div class="header-ct-center menu-moblie">
                     <div class="nav-wrap">
                         <nav class="main-nav mobile">
                             <ul id="menu-primary-menu" class="menu">
                                 <li class="menu-item menu-item-has-children-mobile current-item">
                                     <a href="/" class="iteam-menu">Inicio</a>

                                 </li>
                                 <li class="menu-item menu-item-has-children-mobile">
                                     <a class="iteam-menu">Menú 1</a>
                                     <ul class="sub-menu-mobile">
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 1</a>
                                         </li>
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 2</a>
                                         </li>
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 3</a>
                                         </li>

                                     </ul>
                                 </li>

                                 <li class="menu-item menu-item-has-children-mobile">
                                     <a class="iteam-menu">Menú 2</a>

                                     <ul class="sub-menu-mobile">
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 21</a>
                                         </li>
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 22</a>
                                         </li>
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 23</a>
                                         </li>

                                     </ul>
                                 </li>
                                 <li class="menu-item menu-item-has-children-mobile">
                                     <a class="iteam-menu">Menú 3</a>

                                     <ul class="sub-menu-mobile">
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 31</a>
                                         </li>
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 32</a>
                                         </li>
                                         <li class="menu-item menu-item-mobile">
                                             <a href="">Sub 33</a>
                                         </li>

                                     </ul>
                                 </li>


                             </ul>
                         </nav>
                     </div>
                 </div>

                 <div class="categories">
                     <div class="sub-categorie-mobile">
                         <ul class="pop-up">

                             @foreach ($categorias as $categoria)
                                 <li class="categories-mobile">
                                     <a href="#"><span class="{{ $categoria->icono }}"></span>
                                         {{ $categoria->nombre }}</a>
                                     <div class="group-menu-category-mobile">
                                         <div class="menu left">
                                             <ul>
                                                 @foreach ($categoria->subcategorias as $subcategoria)
                                                     <li>
                                                         <a href="#">
                                                             {{ $subcategoria->nombre }}
                                                         </a>
                                                     </li>
                                                 @endforeach

                                             </ul>
                                         </div>

                                     </div>
                                 </li>
                             @endforeach
                         </ul>
                     </div>

                 </div>


             </div>
         </div>

         <div class="header-customize-item button">
             @auth

                 @php
                     $tipoUsuario = Auth::user()->tipoUsuario?->nombre;
                 @endphp

                 @switch($tipoUsuario)
                     @case('administrador')
                         <a href="{{ url('/admin') }}">
                             Panel de administración
                         </a>
                     @break

                     @case('empresa')
                         <a href="{{ url('/empresa/perfil') }}">
                             Mi perfil
                         </a>
                     @break

                     @case('estudiante')
                     @case('graduado')

                     @case('docente')
                         <a href="{{ url('/usuario/perfil') }}">
                             Mi perfil
                         </a>
                     @break
                 @endswitch
             @else
                 <a href="{{ route('login') }}">
                     Iniciar sesión
                 </a>

             @endauth
         </div>


     </div>
 </div>
 <header id="header" class="header header-default header-fixed">
     <div class="tf-container ct2">
         <div class="row">
             <div class="col-md-12">
                 <div class="sticky-area-wrap">
                     <div class="header-ct-left">
                         <div id="logo" class="logo">
                             <a href="/">
                                 <img class="site-logo" src="{{ asset('assets/img/logo-2.png') }}" alt="Logo">

                             </a>
                         </div>
                         <div class="categories">
                             <a href="#"><span class="icon-grid"></span>Categorías</a>
                             <div class="sub-categorie">
                                 <ul class="pop-up">

                                     @foreach ($categorias as $categoria)
                                         <li>
                                             <a href="#">
                                                 <span class="{{ $categoria->icono }}"></span>
                                                 {{ $categoria->nombre }}
                                             </a>
                                             <div class="group-menu-category">
                                                 <div class="menu right">
                                                     <h6>Subcategorías</h6>
                                                     <ul>

                                                         @foreach ($categoria->subcategorias as $subcategoria)
                                                             <li>
                                                                 <a href="#">
                                                                     {{ $subcategoria->nombre }}
                                                                 </a>
                                                             </li>
                                                         @endforeach
                                                     </ul>
                                                 </div>

                                             </div>
                                         </li>
                                     @endforeach
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="header-ct-center">
                         <div class="nav-wrap">
                             <nav id="main-nav" class="main-nav">
                                 <ul id="menu-primary-menu" class="menu">
                                     <li class="menu-item current-item">
                                         <a href="#">Inicio </a>

                                     </li>
                                     <li class="menu-item menu-item-has-children">
                                         <a href="#">Menú 1 </a>
                                         <ul class="sub-menu st1">

                                             <li class="nav-sub">
                                                 <a href="#">Sub 1</a>
                                             </li>
                                             <li class="nav-sub">
                                                 <a href="#">Sub 2</a>
                                             </li>
                                             <li class="nav-sub">
                                                 <a href="#">Sub 3</a>
                                             </li>
                                         </ul>
                                     </li>

                                     <li class="menu-item menu-item-has-children">
                                         <a href="#">Menú 2 </a>
                                         <ul class="sub-menu st1">

                                             <li class="nav-sub">
                                                 <a href="#">Sub 2 1</a>
                                             </li>
                                             <li class="nav-sub">
                                                 <a href="#">Sub 2 2</a>
                                             </li>
                                             <li class="nav-sub">
                                                 <a href="#">Sub 2 3</a>
                                             </li>
                                         </ul>
                                     </li>
                                     <li class="menu-item menu-item-has-children">
                                         <a href="#">Menú 3 </a>
                                         <ul class="sub-menu st1">

                                             <li class="nav-sub">
                                                 <a href="#">Sub 3 1</a>
                                             </li>
                                             <li class="nav-sub">
                                                 <a href="#">Sub 3 2</a>
                                             </li>
                                             <li class="nav-sub">
                                                 <a href="#">Sub 3 3</a>
                                             </li>
                                         </ul>
                                     </li>
                                 </ul>
                             </nav>
                         </div>
                     </div>
                     <div class="header-ct-right">                       

                         <div class="header-customize-item button">
                             @auth

                                 @php
                                     $tipoUsuario = Auth::user()->tipoUsuario?->nombre;
                                 @endphp

                                 @switch($tipoUsuario)
                                     @case('administrador')
                                         <a href="{{ url('/admin') }}">
                                             Panel de administración
                                         </a>
                                     @break

                                     @case('empresa')
                                         <a href="{{ url('/empresa/perfil') }}">
                                             Mi perfil
                                         </a>
                                     @break

                                     @case('estudiante')
                                     @case('graduado')

                                     @case('docente')
                                         <a href="{{ url('/usuario/perfil') }}">
                                             Mi perfil
                                         </a>
                                     @break
                                 @endswitch
                             @else
                                 <a href="{{ route('login') }}">
                                     Iniciar sesión
                                 </a>

                             @endauth
                         </div>
                     </div>
                     <div class="nav-filter">
                         <div class="nav-mobile"><span></span></div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </header>
