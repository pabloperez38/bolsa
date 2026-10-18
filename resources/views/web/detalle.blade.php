@extends('web.layouts.app')

@section('title', config('app.name') . ' - ' . $trabajo->titulo)

@section('content')

    @include('web.components.headersimple')

    <div class="oferta-detalle">

        {{-- ENCABEZADO DE LA OFERTA --}}

        <section class="offer-hero">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="wd-job-author2">

                            <div class="content-left">
                                <div class="content">

                                    <h3>{{ $trabajo->titulo }}</h3>

                                    <ul class="job-info">

                                        @if ($trabajo->localidad)
                                            <li>
                                                <span class="icon-map-pin"></span>
                                                <span>{{ $trabajo->localidad->nombre }}</span>
                                            </li>
                                        @endif

                                        @if ($trabajo->fecha_publicacion)
                                            <li>
                                                <span class="icon-calendar"></span>
                                                <span>
                                                    Publicada el
                                                    {{ $trabajo->fecha_publicacion->format('d/m/Y') }}
                                                </span>
                                            </li>
                                        @endif

                                    </ul>

                                    <ul class="tags">

                                        @if ($trabajo->categoria)
                                            <li>
                                                <a href="#">
                                                    {{ $trabajo->categoria->nombre }}
                                                </a>
                                            </li>
                                        @endif

                                        @if ($trabajo->subcategoria)
                                            <li>
                                                <a href="#">
                                                    {{ $trabajo->subcategoria->nombre }}
                                                </a>
                                            </li>
                                        @endif

                                        @if ($trabajo->tipoContratacion)
                                            <li>
                                                <a href="#">
                                                    {{ $trabajo->tipoContratacion->nombre }}
                                                </a>
                                            </li>
                                        @endif

                                        @if ($trabajo->modalidad)
                                            <li>
                                                <a href="#">
                                                    {{ $trabajo->modalidad->nombre }}
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                    <hr>
                                    <div>
                                        <h6>Descripción de la oferta</h6>

                                        <div class="descripcion-oferta">
                                            {{ $trabajo->descripcion }}
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="content-right">

                                <div class="top">

                                    @if ($yaPostulado)
                                        <button type="button" class="btn btn-postular" disabled>
                                            <i class="icon-check"></i>
                                            Ya te postulaste
                                        </button>
                                    @else
                                        <form method="POST" action="{{ route('usuario.postularse', $trabajo->id) }}"
                                            id="formPostulacion">

                                            @csrf

                                            <button type="submit" class="btn btn-postular">
                                                <i class="icon-send"></i>
                                                Postularme ahora
                                            </button>

                                        </form>
                                    @endif

                                </div>

                                @if ($trabajo->fecha_cierre)
                                    <div class="bottom">

                                        <div class="gr-rating">

                                            @if ($trabajo->fechaCierreVigente())
                                                <p>
                                                    <i class="icon-calendar"></i>
                                                    {{ $trabajo->diasRestantes() }}
                                                    {{ $trabajo->diasRestantes() == 1 ? 'día restante' : 'días restantes' }}
                                                </p>
                                            @else
                                                <p>
                                                    Publicación finalizada
                                                </p>
                                            @endif

                                        </div>

                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        {{-- DESCRIPCIÓN Y EMPRESA --}}

        <section class="offer-main">
            <div class="tf-container">
                <div class="row">

                    {{-- CONTENIDO PRINCIPAL --}}

                    <div class="col-lg-8 mb-4 mb-lg-0">

                        <article class="job-article tf-tab single-job">

                            <div class="content-tab">
                                <div class="inner-content">

                                    @if ($relacionados->count() > 0)

                                        <div class="related-job">

                                            <h6>También te puede interesar</h6>

                                            @foreach ($relacionados as $relacionado)
                                                <div class="features-job">

                                                    <div class="job-archive-header">

                                                        <div class="inner-box">

                                                            <div class="box-content">

                                                                <h4>
                                                                    {{ $relacionado->empresa->nombre }}
                                                                </h4>

                                                                <h3>
                                                                    {{ $relacionado->titulo }}
                                                                </h3>

                                                                <ul>

                                                                    <li>
                                                                        <span class="icon-map-pin"></span>
                                                                        {{ $relacionado->ubicacion }}
                                                                    </li>

                                                                    <li>
                                                                        <span class="icon-calendar"></span>
                                                                        {{ $relacionado->fecha_publicacion?->format('d/m/Y') }}
                                                                    </li>

                                                                </ul>

                                                                <span class="tipo_oferta">

                                                                    @if ($relacionado->tipoOferta)
                                                                        {{ $relacionado->tipoOferta->nombre }}
                                                                    @endif

                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="job-archive-footer">

                                                        <div class="job-footer-left">

                                                            <ul class="job-tag">

                                                                @if ($relacionado->tipoContratacion)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('web.oferta.detalle', [
                                                                                'slug' => $relacionado->slug,
                                                                                'id' => $relacionado->id,
                                                                            ]) }}">
                                                                            {{ $relacionado->tipoContratacion->nombre }}
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                @if ($relacionado->modalidad)
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('web.oferta.detalle', [
                                                                                'slug' => $relacionado->slug,
                                                                                'id' => $relacionado->id,
                                                                            ]) }}">
                                                                            {{ $relacionado->modalidad->nombre }}
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                            </ul>

                                                        </div>

                                                        <div class="job-footer-right">

                                                            <p class="days">

                                                                @if ($relacionado->fecha_cierre)
                                                                    @if ($relacionado->fechaCierreVigente())
                                                                        Termina en
                                                                        {{ $relacionado->diasRestantes() }}
                                                                        {{ $relacionado->diasRestantes() == 1 ? 'día' : 'días' }}
                                                                    @else
                                                                        Publicación finalizada
                                                                    @endif
                                                                @endif

                                                            </p>

                                                        </div>

                                                    </div>

                                                    <a href="{{ route('web.oferta.detalle', [
                                                        'slug' => $relacionado->slug,
                                                        'id' => $relacionado->id,
                                                    ]) }}"
                                                        class="jobtex-link-item" tabindex="0">
                                                    </a>

                                                </div>
                                            @endforeach

                                        </div>

                                    @endif

                                </div>
                            </div>

                        </article>

                    </div>

                    {{-- INFORMACIÓN DE LA EMPRESA --}}

                    <div class="col-lg-4">

                        <aside class="company-card po-sticky job-sg">

                            <div class="company-heading">

                                <div class="company-avatar">
                                    <i class="icon-briefcase"></i>
                                </div>

                                <span class="company-label">
                                    Empresa empleadora
                                </span>

                                <h4>
                                    {{ $trabajo->empresa->nombre ?? 'Empresa' }}
                                </h4>

                            </div>

                            <div class="company-body">

                                @if ($trabajo->empresa?->descripcion)
                                    <p class="company-description">
                                        {{ $trabajo->empresa->descripcion }}
                                    </p>
                                @endif

                                <div class="company-info-item">

                                    <div class="category">Empresa</div>

                                    <div class="detail">
                                        @if ($trabajo->empresa)
                                            {{ $trabajo->empresa->nombre }}
                                        @else
                                            No disponible
                                        @endif
                                    </div>

                                </div>

                                @if ($trabajo->empresa?->email)
                                    <div class="company-info-item">

                                        <div class="category">Correo electrónico</div>

                                        <div class="detail">
                                            <a href="mailto:{{ $trabajo->empresa->email }}">
                                                {{ $trabajo->empresa->email }}
                                            </a>
                                        </div>

                                    </div>
                                @endif

                                <div class="company-social">
                                    <span>Redes profesionales</span>

                                    <ul class="list-social">

                                        <li>
                                            <a href="#" aria-label="Facebook">
                                                <i class="icon-facebook"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" aria-label="LinkedIn">
                                                <i class="icon-linkedin2"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" aria-label="Twitter">
                                                <i class="icon-twitter"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" aria-label="Instagram">
                                                <i class="icon-instagram1"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                            </div>

                        </aside>

                    </div>

                </div>
            </div>
        </section>

    </div>

    @include('web.components.footer')

@endsection
