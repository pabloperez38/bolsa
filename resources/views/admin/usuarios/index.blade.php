@extends('admin.layouts.app')

@section('title', 'Usuarios')

@section('content')

    @include('admin.components.header')

    @include('admin.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">Usuarios</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
