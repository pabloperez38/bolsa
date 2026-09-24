 <section class="tf-slider sl1 parallax">
     <div class="tf-container">
         <div class="row">
             <div class="col-xl-8">
                 <div class="content">
                     <div class="heading">
                         <h2 class="text-white">
                             Encontrá el trabajo que se adapte a vos
                         </h2>
                         <p class="text-white">
                             Descubrí oportunidades laborales, pasantías y propuestas profesionales de organizaciones
                             vinculadas con nuestra comunidad universitaria.
                         </p>
                     </div>
                     <div class="form-sl">
                         <form method="post">
                             <div class="row-group-search home1">
                                 <div class="form-group-1">
                                     <input type="text" class="input-filter-search"
                                         placeholder="Ingresá una palabra clave" />
                                 </div>
                                 <div class="form-group-2">
                                     <span class="icon-map-pin"></span>
                                     <select id="select-location" class="select-location">
                                         <option value="">
                                             Todas las ubicaciones
                                         </option>
                                         @foreach ($localidades as $localidad)
                                             <option value="{{ $localidad->id }}">
                                                 {{ $localidad->nombre }}
                                             </option>
                                         @endforeach

                                     </select>
                                 </div>
                                 <div class="form-group-4">
                                     <button type="submit" class="btn btn-find">
                                         Buscar
                                     </button>
                                 </div>
                             </div>
                         </form>
                         <!-- End Job  Search Form-->
                     </div>

                 </div>
             </div>
         </div>
     </div>
     <div class="overlay"></div>
 </section>
