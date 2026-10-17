@extends('web.layouts.app')

@section('title', config('app.name') . ' - ' . $trabajo->titulo)

@section('content')

    @include('web.components.headersimple')

    <style>
        .oferta-detalle {
            --oferta-primary: #176b50;
            --oferta-primary-dark: #10513d;
            --oferta-text: #202b38;
            --oferta-muted: #718096;
            --oferta-border: #e5eaf0;
            --oferta-bg: #f6f8fb;
        }

        .oferta-detalle .offer-hero {
            padding: 44px 0 34px;
            background: linear-gradient(135deg, #f0f8f4 0%, #f7fafc 65%, #edf4f9 100%);
            border-bottom: 1px solid var(--oferta-border);
        }

        .oferta-detalle .wd-job-author2 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            padding: 32px;
            background: #fff;
            border: 1px solid var(--oferta-border);
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(24, 39, 56, .055);
        }

        .oferta-detalle .content-left {
            flex: 1;
            min-width: 0;
        }

        .oferta-detalle .content-left h3 {
            margin: 0 0 20px;
            color: var(--oferta-text);
            font-size: clamp(25px, 3vw, 35px);
            line-height: 1.25;
            font-weight: 800;
            letter-spacing: -.7px;
            overflow-wrap: anywhere;
        }

        .oferta-detalle .job-info {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 24px;
            margin: 0 0 22px;
            padding: 0;
            list-style: none;
        }

        .oferta-detalle .job-info li {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #657386;
            font-size: 14px;
        }

        .oferta-detalle .job-info li span:first-child {
            color: var(--oferta-primary);
            font-size: 17px;
        }

        .oferta-detalle .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .oferta-detalle .tags li a {
            display: inline-flex;
            align-items: center;
            padding: 8px 13px;
            border: 1px solid #dcebe3;
            border-radius: 8px;
            background: #f0f8f3;
            color: #236649;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .oferta-detalle .tags li a:hover {
            background: #e1f1e7;
            border-color: #b8dbc6;
        }

        .oferta-detalle .content-right {
            flex: 0 0 235px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 18px;
        }

        .oferta-detalle .content-right .top,
        .oferta-detalle .content-right .bottom {
            width: 100%;
        }

        .oferta-detalle .content-right form {
            width: 100%;
        }

        .oferta-detalle .btn-postular {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 100%;
            min-height: 52px;
            padding: 14px 18px;
            border: 1px solid var(--oferta-primary);
            border-radius: 10px;
            background: var(--oferta-primary);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            transition: background .2s ease, transform .2s ease;
        }

        .oferta-detalle .btn-postular:hover:not(:disabled) {
            background: var(--oferta-primary-dark);
            transform: translateY(-2px);
        }

        .oferta-detalle .btn-postular:disabled {
            border-color: #cce8d7;
            background: #edf8f0;
            color: #216743;
            opacity: 1;
            cursor: default;
        }

        .oferta-detalle .gr-rating {
            padding: 14px;
            border-radius: 10px;
            background: var(--oferta-bg);
            text-align: center;
        }

        .oferta-detalle .gr-rating p {
            margin: 0;
            color: #637185;
            font-size: 13px;
            font-weight: 600;
        }

        .oferta-detalle .offer-main {
            padding: 42px 0 64px;
            background: var(--oferta-bg);
        }

        .oferta-detalle .job-article {
            overflow: hidden;
            border: 1px solid var(--oferta-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 24px rgba(24, 39, 56, .035);
        }

        .oferta-detalle .content-tab {
            padding: 32px;
        }

        .oferta-detalle .inner-content>h4 {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 24px;
            color: var(--oferta-text);
            font-size: 23px;
            font-weight: 800;
        }

        .oferta-detalle .inner-content>h4::before {
            width: 5px;
            height: 27px;
            border-radius: 5px;
            background: var(--oferta-primary);
            content: "";
        }

        .oferta-detalle .descripcion-oferta {
            color: #536174;
            font-size: 15px;
            line-height: 1.95;
            overflow-wrap: anywhere;
        }

        .oferta-detalle .related-job {
            margin-top: 34px;
        }

        .oferta-detalle .related-job>h6 {
            margin: 0 0 20px;
            color: var(--oferta-text);
            font-size: 20px;
            font-weight: 800;
        }

        .oferta-detalle .features-job {
            position: relative;
            margin-bottom: 16px;
            padding: 22px;
            border: 1px solid var(--oferta-border);
            border-radius: 12px;
            background: #fff;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .oferta-detalle .features-job:hover {
            transform: translateY(-2px);
            border-color: #bfd9cb;
            box-shadow: 0 8px 22px rgba(24, 39, 56, .06);
        }

        .oferta-detalle .features-job .box-content h4 {
            margin: 0 0 7px;
            color: var(--oferta-primary);
            font-size: 13px;
            font-weight: 700;
        }

        .oferta-detalle .features-job .box-content h3 {
            margin: 0 0 14px;
            color: var(--oferta-text);
            font-size: 18px;
            line-height: 1.45;
            font-weight: 800;
        }

        .oferta-detalle .features-job .box-content ul {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 20px;
            margin: 0 0 14px;
            padding: 0;
            list-style: none;
        }

        .oferta-detalle .features-job .box-content ul li {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--oferta-muted);
            font-size: 12px;
        }

        .oferta-detalle .features-job .tipo_oferta {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 6px;
            background: #edf5ff;
            color: #285c94;
            font-size: 11px;
            font-weight: 700;
        }

        .oferta-detalle .job-archive-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #edf0f4;
        }

        .oferta-detalle .job-tag {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .oferta-detalle .job-tag li a {
            display: inline-block;
            padding: 6px 9px;
            border: 1px solid var(--oferta-border);
            border-radius: 6px;
            color: #5c6879;
            font-size: 11px;
            text-decoration: none;
        }

        .oferta-detalle .job-footer-right .days {
            margin: 0;
            color: var(--oferta-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .oferta-detalle .company-card {
            overflow: hidden;
            border: 1px solid var(--oferta-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 5px 24px rgba(24, 39, 56, .035);
        }

        .oferta-detalle .company-heading {
            padding: 25px 24px;
            background: linear-gradient(135deg, #176b50, #124c3b);
            color: #fff;
        }

        .oferta-detalle .company-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 13px;
            background: rgba(255, 255, 255, .13);
            font-size: 23px;
        }

        .oferta-detalle .company-heading .company-label {
            display: block;
            margin-bottom: 5px;
            color: #d4eadf;
            font-size: 12px;
            font-weight: 600;
        }

        .oferta-detalle .company-heading h4 {
            margin: 0;
            color: #fff;
            font-size: 21px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .oferta-detalle .company-body {
            padding: 24px;
        }

        .oferta-detalle .company-description {
            margin: 0 0 22px;
            color: #687589;
            font-size: 13px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        .oferta-detalle .company-info-item {
            padding: 14px 0;
            border-top: 1px solid #edf0f4;
        }

        .oferta-detalle .company-info-item:first-child {
            border-top: 0;
        }

        .oferta-detalle .company-info-item .category {
            margin-bottom: 5px;
            color: #8994a4;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .oferta-detalle .company-info-item .detail {
            color: var(--oferta-text);
            font-size: 14px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .oferta-detalle .company-info-item a {
            color: var(--oferta-primary);
            text-decoration: none;
        }

        .oferta-detalle .company-social {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #edf0f4;
            color: #687589;
            font-size: 13px;
            font-weight: 700;
        }

        .oferta-detalle .company-social .list-social {
            display: flex;
            gap: 9px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .oferta-detalle .company-social .list-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border: 1px solid var(--oferta-border);
            border-radius: 9px;
            color: #526174;
            text-decoration: none;
            transition: .2s ease;
        }

        .oferta-detalle .company-social .list-social a:hover {
            border-color: #c5dfd0;
            background: #eff8f2;
            color: var(--oferta-primary);
        }

        @media (max-width: 991px) {
            .oferta-detalle .wd-job-author2 {
                align-items: stretch;
                flex-direction: column;
                gap: 26px;
                padding: 25px;
            }

            .oferta-detalle .content-right {
                flex-basis: auto;
                max-width: 100%;
            }

            .oferta-detalle .offer-hero {
                padding: 28px 0;
            }

            .oferta-detalle .offer-main {
                padding: 28px 0 42px;
            }
        }

        @media (max-width: 575px) {

            .oferta-detalle .wd-job-author2,
            .oferta-detalle .content-tab {
                padding: 20px;
            }

            .oferta-detalle .features-job {
                padding: 17px;
            }

            .oferta-detalle .job-archive-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .oferta-detalle .company-body {
                padding: 20px;
            }
        }
    </style>

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

                                    <h4>Descripción de la oferta</h4>

                                    <div class="descripcion-oferta">
                                        {{ $trabajo->descripcion }}
                                    </div>

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
