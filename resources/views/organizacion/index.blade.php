@extends('organizacion.layouts.app')

@section('title', 'Mi organización')

@section('content')

    @include('organizacion.components.header')

    {{-- @include('admin.components.sidebarmenu') --}}    

    @include('organizacion.components.principal')

    @include('organizacion.components.leftmenu')

    @include('organizacion.components.footer')

@endsection
