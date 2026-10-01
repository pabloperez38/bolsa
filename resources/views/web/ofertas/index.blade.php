@extends('web.layouts.app')

@section('title', config('app.name'))

@section('content')

    @include('web.components.headersimple')

    @include('web.components.trabajos-2')

    @include('web.components.footer')

@endsection
