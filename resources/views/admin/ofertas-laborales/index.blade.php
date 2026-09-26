@extends('admin.layouts.app')

@section('title', 'Ofertas Laborales')

@section('content')

    @include('admin.components.header')

    @include('admin.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">Ofertas Laborales</div>
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
                            <div class="dash-search flex">
                                <div class="widget search">
                                    <div class="search-flat">
                                        <form action="#" method="get" role="search" class="search-form">
                                            <input type="search" class="search-field" placeholder="Search" value=""
                                                name="s" title="Search for" required="">
                                            <button class="search-icon search-submit" type="submit"
                                                title="Search"></button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div class="table-content">
                                <div class="wrap-applicants table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Categoría</th>
                                                <th class="center">Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ofertas as $oferta)
                                                <tr class="file-delete">
                                                    <td>
                                                        <div class="candidates-wrap flex2">

                                                            <div class="content">
                                                                <h3>{{ $oferta->titulo }}</h3>
                                                                <div class="now-box flex2">
                                                                    <div class="map color-4">
                                                                        {{ $oferta->Empresa->nombre }} </div>
                                                                    <div class="days"> @php
                                                                        $hoy = now()->startOfDay();
                                                                        $cierre = $oferta->fecha_cierre?->startOfDay();
                                                                    @endphp

                                                                        @if ($cierre)
                                                                            @if ($cierre->isPast())
                                                                                Oferta finalizada
                                                                            @else
                                                                                Faltan {{ $hoy->diffInDays($cierre) }} días
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="status-wrap">
                                                            <div class=""> {{ $oferta->categoria?->nombre }} -
                                                                {{ $oferta->subcategoria?->nombre }}</div>
                                                        </div>
                                                    </td>
                                                    <td class="center">
                                                        <div class="title-day color-1">
                                                            {{ $oferta->fecha_publicacion?->format('d/m/Y') }}</div>
                                                    </td>
                                                    <td>
                                                        <div id="items_1" class="dropdown titles-dropdown">

                                                            <ul>
                                                                <li><span class="icon-eye more-ic"></span> <span>Ver</span>
                                                                </li>
                                                                <li class="remove-file"><span
                                                                        class="icon-trash more-ic"></span><span>Eliminar</span>
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
