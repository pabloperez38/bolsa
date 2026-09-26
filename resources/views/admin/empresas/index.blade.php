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
                                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10Z"
                                                                            fill="#504CFE" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M10.9099 3.73218C11.052 3.77687 11.1762 3.86573 11.2643 3.98583C11.3524 4.10593 11.3999 4.25102 11.3999 4.39998V7.89998H14.1999C14.328 7.89992 14.4536 7.93499 14.5631 8.00136C14.6726 8.06773 14.7618 8.16286 14.821 8.2764C14.8801 8.38994 14.9071 8.51754 14.8988 8.64532C14.8905 8.77309 14.8473 8.89614 14.7739 9.00108L9.87392 16.0011C9.78864 16.1233 9.6666 16.215 9.52556 16.2631C9.38452 16.3111 9.23183 16.3129 9.08971 16.2681C8.94759 16.2234 8.82345 16.1344 8.73537 16.0143C8.64728 15.8941 8.59983 15.749 8.59992 15.6V12.1H5.79992C5.67188 12.1 5.54627 12.065 5.43677 11.9986C5.32727 11.9322 5.23808 11.8371 5.17889 11.7236C5.1197 11.61 5.09279 11.4824 5.10108 11.3546C5.10937 11.2269 5.15255 11.1038 5.22592 10.9989L10.1259 3.99888C10.2113 3.87693 10.3334 3.78539 10.4744 3.73755C10.6154 3.68972 10.7679 3.68808 10.9099 3.73288V3.73218Z"
                                                                            fill="white" />
                                                                    </svg>
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
