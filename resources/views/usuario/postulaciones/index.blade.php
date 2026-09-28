@extends('usuario.layouts.app')

@section('title', 'Mis postulaciones')

@section('content')

    @include('usuario.components.header')

    @include('usuario.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">
                                Mis postulaciones
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flat-dashboard-save flat-dashboard-candidates flat-dashboard-applicants">

            <div class="themes-container">

                <div class="row">

                    <div class="col-lg-12 col-md-12">

                        <div class="applicants bg-white">

                            <div class="table-content">

                                <div class="wrap-applicants table-responsive">

                                    <table>

                                        <thead>

                                            <tr>
                                                <th>Oferta</th>
                                                <th>Tipo</th>
                                                <th>Modalidad</th>
                                                <th>Postulación</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                            @forelse ($postulaciones as $postulacion)

                                                @php
                                                    $trabajo = $postulacion->trabajo;
                                                @endphp

                                                @if ($trabajo)
                                                    <tr class="file-delete">

                                                        {{-- OFERTA --}}
                                                        <td>

                                                            <div class="candidates-wrap flex2">

                                                                <div class="content">

                                                                    <h3>
                                                                        {{ $trabajo->titulo }}
                                                                    </h3>

                                                                    <div class="now-box flex2">

                                                                        {{-- EMPRESA --}}
                                                                        <div class="map color-4">

                                                                            {{ $trabajo->empresa?->nombre ?? 'Sin empresa' }}

                                                                        </div>

                                                                        {{-- CATEGORÍA --}}
                                                                        <div class="days">

                                                                            @if ($trabajo->categoria)
                                                                                <span>
                                                                                    {{ $trabajo->categoria->nombre }}
                                                                                </span>
                                                                            @endif

                                                                        </div>

                                                                    </div>

                                                                    {{-- SUBCATEGORÍA --}}
                                                                    @if ($trabajo->subcategoria)
                                                                        <div class="mt-2">

                                                                            <span>
                                                                                {{ $trabajo->subcategoria->nombre }}
                                                                            </span>

                                                                        </div>
                                                                    @endif

                                                                </div>

                                                            </div>

                                                        </td>


                                                        {{-- TIPO DE OFERTA --}}
                                                        <td>

                                                            <div class="button-status style-2">

                                                                @if ($trabajo->tipoOferta)
                                                                    {{ $trabajo->tipoOferta->nombre }}
                                                                @else
                                                                    -
                                                                @endif

                                                            </div>

                                                        </td>


                                                        {{-- MODALIDAD --}}
                                                        <td>

                                                            <div>

                                                                @if ($trabajo->modalidad)
                                                                    <div class="button-status style-2">
                                                                        {{ $trabajo->modalidad->nombre }}
                                                                    </div>
                                                                @else
                                                                    -
                                                                @endif

                                                                @if ($trabajo->tipoContratacion)
                                                                    <div class="button-status style-2">
                                                                        {{ $trabajo->tipoContratacion->nombre }}
                                                                    </div>
                                                                @endif

                                                            </div>

                                                        </td>

                                                        {{-- FECHA DE POSTULACIÓN / CIERRE --}}
                                                        <td>

                                                            <div class="title-day color-1">

                                                                <strong>
                                                                    {{ $postulacion->fecha_postulacion?->format('d/m/Y') }}
                                                                </strong>

                                                                <br>

                                                                <small>
                                                                    {{ $postulacion->fecha_postulacion?->diffForHumans() }}
                                                                </small>

                                                                @if ($trabajo->fecha_cierre)
                                                                    <br>

                                                                    <small>
                                                                        Cierre:
                                                                        {{ $trabajo->fecha_cierre->format('d/m/Y') }}
                                                                    </small>
                                                                @endif

                                                            </div>

                                                        </td>

                                                        {{-- ESTADO --}}
                                                        <td>

                                                            @switch($postulacion->estado)
                                                                @case('pendiente')
                                                                    <div class="button-status style-2">
                                                                        Pendiente
                                                                    </div>
                                                                @break

                                                                @case('en_revision')
                                                                    <div class="button-status style-2">
                                                                        En revisión
                                                                    </div>
                                                                @break

                                                                @case('seleccionado')
                                                                    <div class="button-status style-2">
                                                                        Seleccionado
                                                                    </div>
                                                                @break

                                                                @case('rechazado')
                                                                    <div class="button-status style-2">
                                                                        Rechazado
                                                                    </div>
                                                                @break

                                                                @case('retirado')
                                                                    <div class="button-status style-2">
                                                                        Retirado
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <div class="button-status style-2">
                                                                        {{ ucfirst($postulacion->estado) }}
                                                                    </div>
                                                            @endswitch

                                                        </td>

                                                        {{-- ACCIONES --}}
                                                        <td>

                                                            <div class="dropdown titles-dropdown">

                                                                <ul>

                                                                    {{-- VER DETALLE --}}
                                                                    <li>

                                                                        <a
                                                                            href="{{ route('web.oferta.detalle', [
                                                                                'slug' => $trabajo->slug,
                                                                                'id' => $trabajo->id,
                                                                            ]) }}">

                                                                            <span class="icon-eye more-ic"></span>

                                                                            <span>
                                                                                Ver detalle
                                                                            </span>

                                                                        </a>

                                                                    </li>

                                                                    {{-- RETIRARSE --}}
                                                                    @if (in_array($postulacion->estado, ['pendiente', 'en_revision']))
                                                                        <li>

                                                                            <form method="POST"
                                                                                action="{{ route('usuario.postulaciones.retirar', $postulacion->id) }}"
                                                                                class="form-retirar-postulacion">

                                                                                @csrf

                                                                                <button type="submit"
                                                                                    style="border: none; background: none; padding: 0; cursor: pointer;">

                                                                                    <span class="icon-close more-ic"></span>

                                                                                    <span>
                                                                                        Retirarme
                                                                                    </span>

                                                                                </button>

                                                                            </form>

                                                                        </li>
                                                                    @endif

                                                                </ul>

                                                            </div>

                                                        </td>

                                                    </tr>
                                                @endif

                                                @empty

                                                    <tr>

                                                        <td colspan="6" class="text-center">

                                                            No tenés postulaciones registradas.

                                                        </td>

                                                    </tr>

                                                @endforelse

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
