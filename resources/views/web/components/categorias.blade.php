  <section class="job-category-section">
      <div class="tf-container">
          <div class="row">
              <div class="col-md-12">
                  <div class="tf-title">
                      <div class="group-title">
                          <h1>Buscar por categoría</h1>
                      </div>
                      <a href="#" class="tf-button">
                          Todas las categorías
                          <span class="icon-arrow-right2"></span>
                      </a>
                  </div>
              </div>
              <!-- wd-job-category -->
              <div class="col-md-12">
                  <div class="group-category-job wow fadeInUp">

                      @foreach ($categorias as $categoria)
                          <div class="job-category-box">
                              <div class="job-category-header">
                                  <h1>
                                      <a href="#">{{ $categoria->nombre }}</a>
                                  </h1>
                                  <p>{{ $categoria->descripcion }}</p>
                              </div>
                              <a href="#" class="btn-category-job">Ver trabajos
                                  <span class="icon-keyboard_arrow_right"></span></a>
                          </div>
                      @endforeach

                  </div>
              </div>
          </div>
      </div>
  </section>
