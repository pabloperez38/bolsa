<section class="jobs-section-three jobs-elegantes">
    <div class="tf-container">

        <div class="tf-title style-2 jobs-elegantes-heading">
            <div class="group-title">
                <span class="jobs-elegantes-kicker">OPORTUNIDADES PROFESIONALES</span>

                <h2>Ofertas laborales</h2>

                <p>
                    Encontrá oportunidades laborales y profesionales seleccionadas para vos.
                    Explorá las propuestas disponibles y descubrí nuevas oportunidades
                    para desarrollar tu carrera.
                </p>
            </div>
        </div>

        <div class="row wow fadeInUp jobs-elegantes-grid">

            @foreach ($trabajos as $trabajo)
                <div class="col-lg-6 jobs-elegantes-column">
                    <div class="features-job jobs-elegantes-card">

                        <div class="job-archive-header jobs-elegantes-header">
                            <div class="inner-box">
                                <div class="box-content">

                                    <div class="jobs-elegantes-empresa">
                                        <h4>{{ $trabajo->empresa->nombre }}</h4>

                                        <span class="jobs-elegantes-tipo">
                                            @if ($trabajo->tipoOferta)
                                                {{ $trabajo->tipoOferta->nombre }}
                                            @endif
                                        </span>
                                    </div>

                                    <h3 class="jobs-elegantes-titulo">
                                        {{ $trabajo->titulo }}
                                    </h3>

                                    <div class="jobs-elegantes-meta">
                                        <div class="jobs-elegantes-meta-item">
                                            <span class="icon-map-pin"></span>
                                            <span>{{ $trabajo->ubicacion }}</span>
                                        </div>

                                        <div class="jobs-elegantes-meta-item">
                                            <span class="icon-calendar"></span>
                                            <span>
                                                {{ $trabajo->fecha_publicacion?->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="job-archive-footer jobs-elegantes-footer">

                            <div class="job-footer-left">
                                <ul class="job-tag jobs-elegantes-tags">

                                    {{-- Tipo de contratación --}}
                                    @if ($trabajo->tipoContratacion)
                                        <li>
                                            <a href="{{ route('web.oferta.detalle', [
                                                'slug' => $trabajo->slug,
                                                'id' => $trabajo->id,
                                            ]) }}">
                                                {{ $trabajo->tipoContratacion->nombre }}
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Modalidad --}}
                                    @if ($trabajo->modalidad)
                                        <li>
                                            <a href="{{ route('web.oferta.detalle', [
                                                'slug' => $trabajo->slug,
                                                'id' => $trabajo->id,
                                            ]) }}">
                                                {{ $trabajo->modalidad->nombre }}
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>

                            <div class="job-footer-right jobs-elegantes-cierre">
                                <p class="days">
                                    @if ($trabajo->fecha_cierre)
                                        @if ($trabajo->fechaCierreVigente())
                                            <span class="jobs-elegantes-vigente">
                                                <span class="icon-clock"></span>
                                                Termina en {{ $trabajo->diasRestantes() }}
                                                {{ $trabajo->diasRestantes() == 1 ? 'día' : 'días' }}
                                            </span>
                                        @else
                                            <span class="jobs-elegantes-finalizado">
                                                Publicación finalizada
                                            </span>
                                        @endif
                                    @endif
                                </p>
                            </div>

                        </div>

                        <a href="{{ route('web.oferta.detalle', [
                            'slug' => $trabajo->slug,
                            'id' => $trabajo->id,
                        ]) }}"
                           class="jobtex-link-item"
                           tabindex="0"></a>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>