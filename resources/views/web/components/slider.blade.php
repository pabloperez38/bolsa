 <section class="tf-slider sl1 parallax">
     <div class="tf-container">
         <div class="row">
             <div class="col-xl-12">
                 <div class="content">
                     <div class="heading">
                         <h2 class="text-white">
                             Encontrá el trabajo que se adapte a vos
                         </h2>
                         <p class="text-white">
                             Descubrí oportunidades laborales, pasantías y propuestas profesionales de Empresa
                             vinculadas con nuestra comunidad universitaria.
                         </p>
                     </div>
                     <div class="form-sl">
                         <form method="GET" action="{{ route('web.ofertas.resultados') }}">
                             <div class="row-group-search home1">
                                 <div class="form-group-1">
                                     <input type="text" class="input-filter-search"
                                         placeholder="Ingresá una palabra clave" name="palabra_clave" />
                                 </div>
                                 <div class="form-group-2">
                                     <span class="icon-map-pin"></span>
                                     <select id="select-location" class="select-location" name="provincia_id">
                                         <option value="">
                                             Todas las provincias
                                         </option>
                                         @foreach ($provincias as $provincia)
                                             <option value="{{ $provincia->id }}">
                                                 {{ $provincia->nombre }}
                                             </option>
                                         @endforeach

                                     </select>
                                 </div>
                                 <div class="form-group-2">
                                     <span class="icon-map-pin"></span>

                                     <select id="select-localidad" name="localidad_id" class="select-location" disabled>
                                         <option value="">Todas las localidades</option>
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


     <script>
         const localidadesPorProvincia =
             {{ Js::from(
                 $provincias->mapWithKeys(
                     fn($provincia) => [
                         $provincia->id => $provincia->localidades->map(
                                 fn($localidad) => [
                                     'id' => $localidad->id,
                                     'nombre' => $localidad->nombre,
                                 ],
                             )->values(),
                     ],
                 ),
             ) }};

         const provincia = document.getElementById('select-location');
         const localidad = document.getElementById('select-localidad');

         provincia.addEventListener('change', function() {
             localidad.innerHTML = '';

             const opcionTodas = document.createElement('option');
             opcionTodas.value = '';
             opcionTodas.textContent = 'Todas las localidades';
             localidad.appendChild(opcionTodas);

             const localidades = localidadesPorProvincia[this.value] || [];

             localidades.forEach(function(item) {
                 const opcion = document.createElement('option');
                 opcion.value = item.id;
                 opcion.textContent = item.nombre;
                 localidad.appendChild(opcion);
             });

             localidad.disabled = !this.value;
         });
     </script>


 </section>
