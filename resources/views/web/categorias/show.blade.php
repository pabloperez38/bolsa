@extends('web.layouts.app')

@section('title', config('app.name') . ' - ' . $categoria->nombre)

@section('content')

    @include('web.components.header')

    @include('web.components.showcategorias')

    @include('web.components.footer')

@endsection
