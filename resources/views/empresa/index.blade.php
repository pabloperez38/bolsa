@extends('Empresa.layouts.app')

@section('title', 'Mi organización')

@section('content')

    @include('Empresa.components.header')

    {{-- @include('admin.components.sidebarmenu') --}}

    @include('Empresa.components.principal')

    @include('Empresa.components.leftmenu')

    @include('Empresa.components.footer')

@endsection
