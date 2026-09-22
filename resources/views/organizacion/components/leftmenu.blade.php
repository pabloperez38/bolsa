 <div class="left-menu">

     <!--- Sidemenu -->
     <div id="sidebar-menu">

         <ul class="downmenu list-unstyled" id="side-menu">

             <li>
                 <a href="{{ route('organizacion.index') }}" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Dashboard</span>
                 </a>
             </li>
             <li>
                 <a href="/organizacion/mi-organizacion" class="tf-effect">
                     <span class="icon-my-apply dash-icon"></span>
                     <span class="dash-titles">Mi organización</span>
                 </a>
             </li>

             <li>
                 <a href="/organizacion/mis-ofertas" class="tf-effect">
                     <span class="icon-my-apply dash-icon"></span>
                     <span class="dash-titles">Mis ofertas</span>
                 </a>
             </li>
             <li>
                 <a href="/organizacion/postulaciones" class="tf-effect">
                     <span class="icon-my-apply dash-icon"></span>
                     <span class="dash-titles">Postulaciones</span>
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
