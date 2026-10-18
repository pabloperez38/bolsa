@extends('web.layouts.app')

@section('title', config('app.name') . ' - ' . $categoria->nombre)

@section('content')

    @include('web.components.headersimple')

    <div class="oferta-detalle">

        {{-- ENCABEZADO DE LA CATEGORÍA --}}

        <section class="offer-hero">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="wd-job-author2">

                            <div class="content-left">
                                <div class="content">

                                    <h3>{{ $categoria->nombre }}</h3>

                                    <ul class="job-info">
                                        <li>
                                            <span class="icon-briefcase"></span>
                                            <span>
                                                {{ $categoria->subcategorias->count() }}
                                                {{ $categoria->subcategorias->count() === 1 ? 'especialidad disponible' : 'especialidades disponibles' }}
                                            </span>
                                            <span>
                                                {{ $trabajos->total() }}
                                                {{ $trabajos->total() === 1 ? 'oferta disponible' : 'ofertas disponibles' }}
                                            </span>
                                        </li>

                                        <li>
                                            <span class="icon-check"></span>
                                            <span>Explorá las oportunidades de esta área</span>
                                        </li>
                                    </ul>

                                    @if ($categoria->descripcion)
                                        <div class="descripcion-oferta">
                                            {{ $categoria->descripcion }}
                                        </div>
                                    @else
                                        <p>
                                            Descubrí especialidades y ofertas laborales
                                            relacionadas con {{ $categoria->nombre }}.
                                        </p>
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- ESPECIALIDADES DE LA CATEGORÍA --}}

        <section class="offer-main">
            <div class="tf-container">
                <div class="row">

                    <div class="col-lg-12 mb-4 mb-lg-0">

                        <article class="job-article tf-tab single-job">

                            <div class="content-tab">
                                <div class="inner-content">

                                    <div class="related-job">

                                        <h6>Explorá las especialidades</h6>
                                        <div class="row">
                                            @forelse ($categoria->subcategorias as $subcategoria)
                                                <div class="col-md-4">
                                                    <div class="features-job">

                                                        <div class="job-archive-header">
                                                            <div class="inner-box">
                                                                <div class="box-content">

                                                                    <h3>
                                                                        {{ $subcategoria->nombre }}
                                                                    </h3>

                                                                    <ul>
                                                                        <li>
                                                                            <span class="icon-briefcase"></span>
                                                                            Especialidad de
                                                                            {{ $categoria->nombre }}
                                                                        </li>
                                                                    </ul>

                                                                    @if ($subcategoria->descripcion)
                                                                        <p>
                                                                            {{ $subcategoria->descripcion }}
                                                                        </p>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="job-archive-footer">
                                                            <div class="job-footer-left">
                                                                <ul class="job-tag">
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('web.ofertas.subcategoria', [
                                                                                'categoriaSlug' => $categoria->slug,
                                                                                'subcategoriaSlug' => $subcategoria->slug,
                                                                            ]) }}">
                                                                            Ver ofertas
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <a href="{{ route('web.ofertas.subcategoria', [
                                                            'categoriaSlug' => $categoria->slug,
                                                            'subcategoriaSlug' => $subcategoria->slug,
                                                        ]) }}"
                                                            class="jobtex-link-item"
                                                            aria-label="Ver ofertas de {{ $subcategoria->nombre }}">
                                                        </a>

                                                    </div>

                                                </div>

                                            @empty

                                                <p>
                                                    Todavía no hay especialidades disponibles
                                                    para esta categoría.
                                                </p>
                                            @endforelse
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </article>

                    </div>

                </div>
            </div>
        </section>

        {{-- OFERTAS DE LA CATEGORÍA --}}

        <section class="offer-main">
            <div class="tf-container">
                <div class="row">

                    <div class="col-lg-12">

                        <article class="job-article tf-tab single-job">

                            <div class="content-tab">
                                <div class="inner-content">

                                    <div class="related-job">

                                        <h6>
                                            Ofertas laborales de {{ $categoria->nombre }}
                                        </h6>

                                        <div class="row">

                                            @forelse ($trabajos as $trabajo)

                                                <div class="col-md-6">
                                                    <div class="features-job">

                                                        <div class="job-archive-header">
                                                            <div class="inner-box">
                                                                <div class="box-content">

                                                                    <h4>
                                                                        {{ $trabajo->empresa?->nombre ?? 'Empresa' }}
                                                                    </h4>

                                                                    <h3>
                                                                        {{ $trabajo->titulo }}
                                                                    </h3>

                                                                    <ul>
                                                                        <li>
                                                                            <span class="icon-map-pin"></span>
                                                                            {{ $trabajo->ubicacion }}
                                                                        </li>

                                                                        <li>
                                                                            <span class="icon-calendar"></span>
                                                                            {{ $trabajo->fecha_publicacion?->format('d/m/Y') }}
                                                                        </li>
                                                                    </ul>

                                                                    <span class="tipo_oferta">
                                                                        {{ $trabajo->tipoOferta?->nombre ?? '' }}
                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="job-archive-footer">

                                                            <div class="job-footer-left">
                                                                <ul class="job-tag">

                                                                    @if ($trabajo->subcategoria)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('web.ofertas.subcategoria', [
                                                                                    'categoriaSlug' => $categoria->slug,
                                                                                    'subcategoriaSlug' => $trabajo->subcategoria->slug,
                                                                                ]) }}">
                                                                                {{ $trabajo->subcategoria->nombre }}
                                                                            </a>
                                                                        </li>
                                                                    @endif

                                                                    @if ($trabajo->tipoContratacion)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('web.oferta.detalle', [
                                                                                    'slug' => $trabajo->slug,
                                                                                    'id' => $trabajo->id,
                                                                                ]) }}">
                                                                                {{ $trabajo->tipoContratacion->nombre }}
                                                                            </a>
                                                                        </li>
                                                                    @endif

                                                                    @if ($trabajo->modalidad)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('web.oferta.detalle', [
                                                                                    'slug' => $trabajo->slug,
                                                                                    'id' => $trabajo->id,
                                                                                ]) }}">
                                                                                {{ $trabajo->modalidad->nombre }}
                                                                            </a>
                                                                        </li>
                                                                    @endif

                                                                </ul>
                                                            </div>

                                                            <div class="job-footer-right">
                                                                <p class="days">

                                                                    @if ($trabajo->fecha_cierre)
                                                                        @if ($trabajo->fechaCierreVigente())
                                                                            Termina en
                                                                            {{ $trabajo->diasRestantes() }}
                                                                            {{ $trabajo->diasRestantes() == 1 ? 'día' : 'días' }}
                                                                        @else
                                                                            Publicación finalizada
                                                                        @endif
                                                                    @endif

                                                                </p>
                                                            </div>

                                                        </div>

                                                        <a href="{{ route('web.oferta.detalle', [
                                                            'slug' => $trabajo->slug,
                                                            'id' => $trabajo->id,
                                                        ]) }}"
                                                            class="jobtex-link-item" tabindex="0">
                                                        </a>

                                                    </div>
                                                </div>

                                            @empty

                                                <p>
                                                    Actualmente no hay ofertas publicadas
                                                    en esta categoría.
                                                </p>

                                            @endforelse
                                        </div>
                                        <div class="mt-4">
                                            {{ $trabajos->links() }}
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </article>

                    </div>

                </div>
            </div>
        </section>

    </div>

    @include('web.components.footer')

@endsection
