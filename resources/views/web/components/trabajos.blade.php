 <section class="jobs-section-three">
     <div class="tf-container">
         <div class="tf-title style-2">
             <div class="group-title">
                 <h2>Ofertas laborales destacadas</h2>
                 <p>
                     Encontrá oportunidades laborales y profesionales seleccionadas para vos. Explorá las propuestas
                     disponibles y descubrí nuevas oportunidades para desarrollar tu carrera.
                 </p>
             </div>
         </div>
         <div class="row wow fadeInUp">

             @foreach ($trabajos as $trabajo)
                 <div class="col-lg-6">
                     <div class="features-job">

                         <div class="job-archive-header">
                             <div class="inner-box">

                                 <div class="logo-company">
                                     <div class="logo-iniciales">
                                         {{ strtoupper(substr($trabajo->Empresa->nombre, 0, 2)) }}
                                     </div>
                                 </div>

                                 <div class="box-content">

                                     <h4>
                                         <a href="#">
                                             {{ $trabajo->Empresa->nombre }}
                                         </a>
                                     </h4>

                                     <h3>
                                         <a href="#">
                                             {{ $trabajo->titulo }}
                                         </a>
                                     </h3>

                                     <ul>
                                         <li>
                                             <span class="icon-map-pin"></span>
                                             {{ $trabajo->ubicacion }}
                                         </li>

                                         <li>
                                             <span class="icon-calendar"></span>
                                             {{ $trabajo->fecha_publicacion?->diffForHumans() }}
                                         </li>
                                     </ul>

                                     <span class="tipo_oferta"> {{-- Tipo de oferta: Trabajo / Pasantía --}}
                                         @if ($trabajo->tipoOferta)
                                             {{ $trabajo->tipoOferta->nombre }}
                                         @endif
                                     </span>

                                 </div>
                             </div>
                         </div>

                         <div class="job-archive-footer">

                             <div class="job-footer-left">
                                 <ul class="job-tag">

                                     {{-- Tipo de contratación: Full-time / Part-time / etc. --}}
                                     @if ($trabajo->tipoContratacion)
                                         <li>
                                             <a href="#">
                                                 {{ $trabajo->tipoContratacion->nombre }}
                                             </a>
                                         </li>
                                     @endif

                                     {{-- Modalidad: Presencial / Remoto / Híbrido --}}
                                     @if ($trabajo->modalidad)
                                         <li>
                                             <a href="#">
                                                 {{ $trabajo->modalidad->nombre }}
                                             </a>
                                         </li>
                                     @endif

                                 </ul>
                             </div>

                             <div class="job-footer-right">

                                 <p class="days">
                                     @if ($trabajo->fecha_cierre)
                                         Termina en {{ $trabajo->fecha_cierre->diffForHumans() }}
                                     @endif
                                 </p>

                             </div>
                         </div>

                         <a href="#" class="jobtex-link-item" tabindex="0"></a>

                     </div>
                 </div>
             @endforeach

             <div class="col-md-12">
                 <div class="wrap-button">
                     <a href="find-jobs-list.html" class="tf-button style-1">
                         Ver todas las ofertas
                         <span class="icon-keyboard_arrow_right"></span>
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </section>
