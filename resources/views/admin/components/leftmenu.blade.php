 <div class="left-menu">

     <!--- Sidemenu -->
     <div id="sidebar-menu">

         <ul class="downmenu list-unstyled" id="side-menu">

             <li>
                 <a href="/admin" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Dashboard</span>
                 </a>
             </li>
             <li>
                 <a href="/admin/usuarios" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Usuarios</span>
                 </a>
             </li>
             <li>
                 <a href="/admin/empresas" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Empresas</span>
                 </a>
             </li>
             <li>
                 <a href="/admin/ofertas-laborales" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Ofertas laborales</span>
                 </a>
             </li>
             <li>
                 <a href="/admin/categorias" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Categorías</span>
                 </a>
             </li>
             <li>
                 <a href="/admin/postulaciones" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Postulaciones</span>
                 </a>
             </li>

             <li>
                 <a href="/admin/observatorio" class="tf-effect">
                     <span class="icon-my-apply dash-icon"></span>
                     <span class="dash-titles">Observatorio</span>
                 </a>
             </li>
             <li>
                 <a href="/admin/perfil" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Perfil</span>
                 </a>
             </li>
             <li>
                 <a href="/admin/configuracion" class="tf-effect">
                     <span class="icon-my-apply dash-icon"></span>
                     <span class="dash-titles">Configuración</span>
                 </a>
             </li>
             <li>
                 <a href="#" class="tf-effect"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     <span class="icon-log-out dash-icon"></span>
                     <span class="dash-titles">Cerrar sesión</span>
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
             </li>

         </ul>
     </div>
 </div>
