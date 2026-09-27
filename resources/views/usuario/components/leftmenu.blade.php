<div class="left-menu">

    <!-- Sidemenu -->
    <div id="sidebar-menu">

        @php
            $tipoUsuario = auth()->user()->tipoUsuario?->nombre;
        @endphp

        {{-- ===================================================== --}}
        {{-- MENÚ PARA ESTUDIANTE, GRADUADO Y DOCENTE --}}
        {{-- ===================================================== --}}

        @if (in_array($tipoUsuario, ['estudiante', 'graduado', 'docente']))

            <ul class="downmenu list-unstyled" id="side-menu">

                {{-- Dashboard --}}
                <li>
                    <a href="/usuario" class="tf-effect">
                        <span class="icon-dashboard dash-icon"></span>
                        <span class="dash-titles">Dashboard</span>
                    </a>
                </li>

                {{-- Mi perfil --}}
                <li>
                    <a href="/usuario/perfil" class="tf-effect">
                        <span class="icon-dashboard dash-icon"></span>
                        <span class="dash-titles">Mi perfil</span>
                    </a>
                </li>

                {{-- ================================================= --}}
                {{-- OFERTAS SEGÚN TIPO DE USUARIO --}}
                {{-- ================================================= --}}

                @if ($tipoUsuario === 'estudiante')
                    {{-- Estudiante: solamente pasantías --}}
                    <li>
                        <a href="/usuario/pasantias" class="tf-effect">
                            <span class="icon-my-apply dash-icon"></span>
                            <span class="dash-titles">Pasantías disponibles</span>
                        </a>
                    </li>
                @elseif (in_array($tipoUsuario, ['graduado', 'docente']))
                    {{-- Graduado y docente: solamente trabajos --}}
                    <li>
                        <a href="/usuario/trabajos" class="tf-effect">
                            <span class="icon-my-apply dash-icon"></span>
                            <span class="dash-titles">Trabajos disponibles</span>
                        </a>
                    </li>
                @endif

                {{-- Mis postulaciones --}}
                <li>
                    <a href="/usuario/postulaciones" class="tf-effect">
                        <span class="icon-my-apply dash-icon"></span>
                        <span class="dash-titles">Mis postulaciones</span>
                    </a>
                </li>

                {{-- Cerrar sesión --}}
                <li>
                    <a href="#" class="tf-effect"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        <span class="icon-log-out dash-icon"></span>
                        <span class="dash-titles">Cerrar sesión</span>
                    </a>
                </li>

            </ul>


            {{-- ===================================================== --}}
            {{-- MENÚ PARA EMPRESA --}}
            {{-- ===================================================== --}}
        @elseif ($tipoUsuario === 'empresa')
            <ul class="downmenu list-unstyled" id="side-menu">

                {{-- Dashboard --}}
                <li>
                    <a href="/empresa" class="tf-effect">
                        <span class="icon-dashboard dash-icon"></span>
                        <span class="dash-titles">Dashboard</span>
                    </a>
                </li>

                {{-- Mi perfil --}}
                <li>
                    <a href="/empresa/perfil" class="tf-effect">
                        <span class="icon-dashboard dash-icon"></span>
                        <span class="dash-titles">Mi perfil</span>
                    </a>
                </li>

                {{-- Mis publicaciones --}}
                <li>
                    <a href="/empresa/trabajos" class="tf-effect">
                        <span class="icon-my-apply dash-icon"></span>
                        <span class="dash-titles">Mis publicaciones</span>
                    </a>
                </li>

                {{-- Cerrar sesión --}}
                <li>
                    <a href="#" class="tf-effect"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        <span class="icon-log-out dash-icon"></span>
                        <span class="dash-titles">Cerrar sesión</span>
                    </a>
                </li>

            </ul>

        @endif

        {{-- ===================================================== --}}
        {{-- FORMULARIO DE LOGOUT --}}
        {{-- ===================================================== --}}

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

            @csrf

        </form>

    </div>
</div>
