 <div class="mobile-header">
     <div id="logo" class="logo">
         <a href="home-01.html">
             <img class="site-logo" src="images/logo.png" alt="Image" />
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
