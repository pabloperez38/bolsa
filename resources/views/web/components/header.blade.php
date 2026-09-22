 <a id="scroll-top"></a>

 <!-- popup nav menu-mobile-->
 <div class="menu-mobile-popup">
     <div class="modal-menu__backdrop"></div>
     <div class="widget-filter">

         @include('web.components.menumobile')
     </div>
 </div>

 <header id="header" class="header header-default style-absolute header-fixed">
     <div class="tf-container ct2">
         <div class="row">
             <div class="col-md-12">
                 <div class="sticky-area-wrap">
                     <div class="header-ct-left">
                         <div id="logo" class="logo">
                             <a href="/">
                                 <img class="site-logo" id="trans-logo" src="images/logo-white.png" alt="Image" />
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
                         <div class="header-customize-item help">
                             <a href="#"><span class="icon-help-circle"></span></a>
                         </div>

                         <div class="header-customize-item button">
                             <a href="/login">Iniciar sesión</a>
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
