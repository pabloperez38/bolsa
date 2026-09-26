@extends('admin.layouts.app')

@section('title', 'Inicio')

@section('content')

    @include('admin.components.header')

    @include('admin.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">Empresa</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flat-dashboard-following flat-dashboard-candidates flat-dashboard-applicants">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">

                        <div class="applicants bg-white">
                            <div class="dash-search flex">
                                <div class="widget search">
                                    <div class="search-flat">
                                        <form action="#" method="get" role="search" class="search-form">
                                            <input type="search" class="search-field" placeholder="Buscar..."
                                                value="" name="s" title="Buscar por" required="">
                                            <button class="search-icon search-submit" type="submit"
                                                title="Buscar"></button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div class="table-content">
                                <div class="wrap-applicants table-responsive">
                                    <table>

                                        <tbody>
                                            @foreach ($empresas as $empresa)
                                                <tr class="file-delete">
                                                    <td>
                                                        <div class="candidates-wrap flex2">
                                                            <div class="images">
                                                                <img src="../images/dashboard/logo-company-1.png"
                                                                    alt="">
                                                            </div>
                                                            <div class="content">

                                                                <div class="title-box flex2">
                                                                    <h3>{{ $empresa->nombre }}</h3>
                                                                  
                                                                </div>
                                                                <div class="now-box flex2">
                                                                    <div class="map color-4">{{ $empresa->direccion }}
                                                                    </div>

                                                                    <div class="briefcase flex2 color-4">
                                                                        <svg width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M13.334 4.66797H2.66732C1.93094 4.66797 1.33398 5.26492 1.33398 6.0013V12.668C1.33398 13.4043 1.93094 14.0013 2.66732 14.0013H13.334C14.0704 14.0013 14.6673 13.4043 14.6673 12.668V6.0013C14.6673 5.26492 14.0704 4.66797 13.334 4.66797Z"
                                                                                stroke="#64666C" stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                            <path
                                                                                d="M10.6673 14V3.33333C10.6673 2.97971 10.5268 2.64057 10.2768 2.39052C10.0267 2.14048 9.68761 2 9.33398 2H6.66732C6.3137 2 5.97456 2.14048 5.72451 2.39052C5.47446 2.64057 5.33398 2.97971 5.33398 3.33333V14"
                                                                                stroke="#64666C" stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </svg>
                                                                        {{ $empresa->descripcion }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="action-wrap">
                                                            <ul class="flex2">
                                                                <li><a class="button-cancel fw-7">5 publicaciones</a></li>
                                                                <li><a class="button-cancel fw-7 remove-file btn-3">Ver
                                                                        detalle</a>
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
