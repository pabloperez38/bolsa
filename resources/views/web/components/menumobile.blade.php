 <div class="mobile-header">
     <div id="logo" class="logo">
         <a href="/">
             <img class="site-logo" src="{{ asset('assets/img/logo-2.png') }}" alt="Logo">
         </a>
     </div>
     <a class="title-button-group"><i class="icon-close"></i></a>

 </div>
 <div class="tf-tab">
     <div class="menu-tab">
         <div class="user-tag active">Menu</div>
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
