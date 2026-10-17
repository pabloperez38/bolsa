@extends('usuario.layouts.app')

@section('title', 'Buscar trabajo')

@section('content')

    @include('usuario.components.header')

    @include('usuario.components.leftmenu')

    <div class="dashboard__content">
        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">
                                @php
                                    $tipoUsuario = auth()->user()->tipoUsuario?->nombre;
                                @endphp
                                {{ $tipoUsuario === 'estudiante' ? 'Pasantías disponibles' : 'Trabajos disponibles' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flat-dashboard-save flat-dashboard-candidates flat-dashboard-applicants">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">

                        <div class="applicants bg-white">

                            <div class="table-content">
                                <div class="wrap-applicants table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Jornada</th>
                                                <th>Modalidad</th>
                                                <th>Finalización</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trabajos as $trabajo)
                                                <tr
                                                    class="file-delete {{ $trabajo->ya_postulado ? 'trabajo-postulado' : '' }}">
                                                    <td>
                                                        <div class="candidates-wrap flex2">

                                                            <div class="content">
                                                                <h3> {{ $trabajo->titulo }}</h3>
                                                                <div class="now-box flex2">
                                                                    <div class="map color-4">
                                                                        {{ $trabajo->empresa->nombre }}</div>
                                                                    <div class="days">
                                                                        <span>{{ $trabajo->fecha_publicacion->format('d/m/Y') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>

                                                        <div class="button-status style-2">
                                                            @if ($trabajo->tipoContratacion)
                                                                {{ $trabajo->tipoContratacion->nombre }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="button-status style-2">
                                                            @if ($trabajo->modalidad)
                                                                {{ $trabajo->modalidad->nombre }}
                                                            @endif
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="title-day color-1">
                                                            @if ($trabajo->fecha_cierre)
                                                                @if ($trabajo->fechaCierreVigente())
                                                                    <span>
                                                                        {{ $trabajo->diasRestantes() }}
                                                                        {{ $trabajo->diasRestantes() == 1 ? 'día restante' : 'días restantes' }}
                                                                    </span>
                                                                @else
                                                                    <span>Publicación finalizada</span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($trabajo->ya_postulado)
                                                            <span class="estado-postulado">
                                                                Ya te postulaste
                                                            </span>
                                                        @else
                                                            <span class="estado-disponible">
                                                                Disponible
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div id="items_1" class="dropdown titles-dropdown">

                                                            <ul>
                                                                <li> <a
                                                                        href="{{ route('web.oferta.detalle', [
                                                                            'slug' => $trabajo->slug,
                                                                            'id' => $trabajo->id,
                                                                        ]) }}">

                                                                        <span class="icon-eye more-ic"></span>

                                                                        <span>
                                                                            Ver detalle
                                                                        </span>

                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
