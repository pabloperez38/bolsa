@extends('web.layouts.app')

@section('title', 'Inicio')

@section('content')

    @include('web.components.header')

    @include('web.components.slider')

    @include('web.components.categorias')

    @include('web.components.trabajos')

    @include('web.components.footer')

@endsection
