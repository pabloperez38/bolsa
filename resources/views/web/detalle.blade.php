@extends('web.layouts.app')

@section('title', config('app.name') . ' - ' . $trabajo->titulo)

@section('content')

    @include('web.components.headersimple')

    <section class="fixed-space">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wd-job-author2">

                        <div class="content-left">

                            <div class="thumb">
                                <img src="{{ asset('assets/images/logo-company/cty4.png') }}"
                                    alt="{{ $trabajo->empresa->nombre ?? 'Empresa' }}">
                            </div>

                            <div class="content">

                                {{-- Título --}}
                                <h6>
                                    {{ $trabajo->titulo }}
                                </h6>

                                <ul class="job-info">

                                    {{-- Localidad --}}
                                    @if ($trabajo->localidad)
                                        <li>
                                            <span class="icon-map-pin"></span>
                                            <span>
                                                {{ $trabajo->localidad->nombre }}
                                            </span>
                                        </li>
                                    @endif

                                    {{-- Fecha de publicación --}}
                                    @if ($trabajo->fecha_publicacion)
                                        <li>
                                            <span class="icon-calendar"></span>
                                            <span>
                                                {{ $trabajo->fecha_publicacion->diffForHumans() }}
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

                                <div class="top">

                                    @if ($yaPostulado)
                                        <button type="button" class="btn btn-popup" disabled>
                                            <i class="icon-check"></i>
                                            Ya te postulaste
                                        </button>
                                    @else
                                        <form method="POST" action="{{ route('usuario.postularse', $trabajo->id) }}"
                                            id="formPostulacion">

                                            @csrf

                                            <button type="submit" class="btn btn-popup">
                                                <i class="icon-send"></i>
                                                Postularme
                                            </button>

                                        </form>
                                    @endif

                                </div>

                            </div>

                            <div class="bottom">

                                <div class="gr-rating">

                                    @if ($trabajo->fecha_cierre)

                                        @if ($trabajo->fecha_cierre->isFuture())
                                            @php
                                                $diasRestantes = (int) ceil(
                                                    now()->diffInHours($trabajo->fecha_cierre) / 24,
                                                );
                                            @endphp

                                            <p>
                                                {{ $diasRestantes }}
                                                {{ $diasRestantes == 1 ? 'día restante' : 'días restantes' }}
                                            </p>
                                        @else
                                            <p>
                                                Publicación finalizada
                                            </p>
                                        @endif

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-jobs-section">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-8">
                    <article class="job-article tf-tab single-job">

                        <div class="content-tab">
                            <div class="inner-content">
                                <h5>Descripción</h5>

                                <p>{{ $trabajo->descripcion }} </p>

                                <div class="related-job">
                                    <h6>Related Jobs</h6>


                                    <div class="features-job mg-bt-0">
                                        <div class="job-archive-header">
                                            <div class="inner-box">
                                                <div class="logo-company">
                                                    <img src="images/logo-company/cty8.png"
                                                        alt="images/logo-company/cty8.png" />
                                                </div>
                                                <div class="box-content">
                                                    <h4>
                                                        <a href="jobs-single.html">Tamari Law Group LLC</a>
                                                    </h4>
                                                    <h3>
                                                        <a href="jobs-single.html">HR Administration</a>
                                                        <span class="icon-bolt"></span>
                                                    </h3>
                                                    <ul>
                                                        <li>
                                                            <span class="icon-map-pin"></span>
                                                            Las Vegas, NV 89107, USA
                                                        </li>
                                                        <li>
                                                            <span class="icon-calendar"></span>
                                                            2 days ago
                                                        </li>
                                                    </ul>
                                                    <span class="icon-heart"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="job-archive-footer">
                                            <div class="job-footer-left">
                                                <ul class="job-tag">
                                                    <li><a href="#"> Part-time</a></li>
                                                    <li><a href="#"> Remote</a></li>
                                                </ul>
                                                <div class="star">
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                    <span class="icon-star-full"></span>
                                                </div>
                                            </div>
                                            <div class="job-footer-right">
                                                <div class="price">
                                                    <span class="icon-dolar1"></span>
                                                    <p>$83,000 - $110,000 <span class="year">/year</span></p>
                                                </div>
                                                <p class="days">24 days left to apply</p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            < </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <div class="cv-form-details po-sticky job-sg">

                        <ul class="list-infor">
                            <li>
                                <div class="category">Empresa</div>
                                <div class="detail">
                                    @if ($trabajo->empresa)
                                        <a href="#" class="category">
                                            {{ $trabajo->empresa->nombre }}
                                        </a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="detail"> {{ $trabajo->empresa->descripcion }}</div>
                            </li>
                            <li>
                                <div class="category">Email</div>
                                <div class="detail"> {{ $trabajo->empresa->email }}</div>
                            </li>
                            <li>
                                <div class="category">Industry</div>
                                <div class="detail">Internet Publishing</div>
                            </li>
                            <li>
                                <div class="category">Company size</div>
                                <div class="detail">51-200 employees</div>
                            </li>
                            <li>
                                <div class="category">Headquarters</div>
                                <div class="detail">3 S Valley , Las Vegas, USA</div>
                            </li>

                        </ul>

                        <div class="wd-social d-flex aln-center">
                            <span>Socials:</span>
                            <ul class="list-social d-flex aln-center">
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-instagram1"></i></a></li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
