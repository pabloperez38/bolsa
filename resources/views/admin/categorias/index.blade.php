@extends('admin.layouts.app')

@section('title', 'Categorías')

@section('content')

    @include('admin.components.header')

    @include('admin.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">Categorías</div>
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

                                <div id="item_category2" class="dropdown">
                                    <a class="btn-selector btn-success" href="{{ route('admin.categorias.create') }}">
                                        Nueva categoría <i class="fa-solid fa-plus"></i>
                                    </a>

                                </div>

                            </div>

                            <div class="table-content">
                                <div class="wrap-applicants table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Categoría</th>
                                                <th>Descripción</th>
                                                <th>Icono</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categorias as $categoria)
                                                <tr class="file-delete">
                                                    <td>
                                                        <div class="candidates-wrap flex2">

                                                            <div class="content">
                                                                <h3>{{ $categoria->nombre }}</h3>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="status-wrap">
                                                            <div class="">
                                                                {{ $categoria->descripcion }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="status-wrap">
                                                            <div class="">
                                                                {{ $categoria->icono }}
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div id="items_1" class="dropdown titles-dropdown">

                                                            <ul>
                                                                <li>
                                                                    <a
                                                                        href="{{ route('admin.categorias.edit', $categoria->id) }}">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                        <span>Editar</span>
                                                                    </a>
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
                        <div class="d-flex justify-content-center mt-4 mb-4">
                            {{ $categorias->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
