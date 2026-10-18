@extends('empresa.layouts.app')

@section('title', config('app.name') . ' - Mis Publicaciones')

@section('content')

    @include('empresa.components.header')

    @include('empresa.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">
                                Mis Publicaciones
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
