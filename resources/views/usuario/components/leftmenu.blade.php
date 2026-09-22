 <div class="left-menu">

     <!--- Sidemenu -->
     <div id="sidebar-menu">

         <ul class="downmenu list-unstyled" id="side-menu">

             <li>
                 <a href="/usuario" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Dashboard</span>
                 </a>
             </li>
             <li>
                 <a href="/usuario/perfil" class="tf-effect">
                     <span class="icon-dashboard dash-icon"></span>
                     <span class="dash-titles">Mi perfil</span>
                 </a>
             </li>

             <li>
                 <a href="/usuario/postulaciones" class="tf-effect">
                     <span class="icon-my-apply dash-icon"></span>
                     <span class="dash-titles">Mis postulaciones</span>
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
