  <div class="dashboard__content">
      <section class="page-title-dashboard">
          <div class="themes-container">
              <div class="row">
                  <div class="col-lg-12 col-md-12 ">
                      <div class="title-dashboard">
                          <div class="title-dash flex2">Mi perfil</div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <section class="flat-dashboard-setting flat-dashboard-setting2">
          <div class="themes-container">
              <div class="row">
                  <div class="col-lg-12 col-md-12">
                      @if (session('success'))
                          @if (session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{ session('success') }}

                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar">
                                  </button>
                              </div>
                          @endif
                      @endif

                      <form action="{{ route('usuario.perfil.update') }}" method="POST" enctype="multipart/form-data">
                          @csrf @method('PUT') <div class="profile-setting bg-white">
                              <div class="author-profile flex2 border-bt">
                                  <div class="wrap-img flex2">
                                      <div class="img-box relative">
                                          @if ($perfil?->foto)
                                              <img class="avatar" id="profileimg"
                                                  src="{{ asset('storage/' . $perfil->foto) }}" alt="Foto de perfil">
                                          @else
                                              <img class="avatar" id="profileimg"
                                                  src="{{ asset('assets/images/dashboard/image-up.jpg') }}"
                                                  alt="Foto de perfil">
                                          @endif
                                      </div>
                                      <div id="upload-profile">
                                          <h5 class="fw-6"> Subir una nueva foto: </h5>
                                          <h6> JPG, JPEG o PNG </h6> <input
                                              class="up-file @error('foto') is-invalid @enderror" id="tf-upload-img"
                                              type="file" name="foto" accept=".jpg,.jpeg,.png"> @error('foto')
                                              <div class="text-danger mt-1"> {{ $message }} </div>
                                          @enderror
                                      </div>
                                  </div>

                              </div> {{-- ========================================== INFORMACIÓN PERSONAL =========================================== --}}
                              <div class="form-infor-profile">
                                  <h3 class="title-info"> Información personal </h3>
                                  <div class="form-infor flex flat-form"> {{-- COLUMNA 1 --}} <div
                                          class="info-box info-wd"> {{-- Nombre --}}
                                          <fieldset>

                                              <label class="title-user fw-7">
                                                  Nombre y apellido
                                              </label>

                                              <input type="text" name="name"
                                                  class="input-form @error('name') is-invalid @enderror"
                                                  value="{{ old('name', $usuario->name) }}" maxlength="255" required>

                                              @error('name')
                                                  <div class="text-danger mt-1">
                                                      {{ $message }}
                                                  </div>
                                              @enderror

                                          </fieldset>
                                          {{-- DNI --}}
                                          <fieldset> <label class="title-user fw-7">
                                                  DNI </label> <input type="text" name="dni"
                                                  class="input-form @error('dni') is-invalid @enderror"
                                                  value="{{ old('dni', $perfil?->dni) }}" maxlength="20"> @error('dni')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </fieldset> {{-- Teléfono --}} <fieldset> <label class="title-user fw-7">
                                                  Teléfono </label> <input type="tel" name="telefono"
                                                  class="input-form @error('telefono') is-invalid @enderror"
                                                  value="{{ old('telefono', $perfil?->telefono) }}" maxlength="50">
                                              @error('telefono')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </fieldset> {{-- Fecha de nacimiento --}} <fieldset> <label class="title-user fw-7">
                                                  Fecha de nacimiento </label> <input type="date"
                                                  name="fecha_nacimiento"
                                                  class="input-form @error('fecha_nacimiento') is-invalid @enderror"
                                                  value="{{ old('fecha_nacimiento', $perfil?->fecha_nacimiento?->format('Y-m-d')) }}">
                                              @error('fecha_nacimiento')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </fieldset>
                                      </div> {{-- COLUMNA 2 --}} <div class="info-box info-wd"> {{-- Email --}}
                                          <fieldset> <label class="title-user fw-7"> Email </label> <input
                                                  type="email" class="input-form" value="{{ $usuario->email }}"
                                                  readonly> </fieldset> {{-- Dirección --}} <fieldset> <label
                                                  class="title-user fw-7"> Dirección </label> <input type="text"
                                                  name="direccion"
                                                  class="input-form @error('direccion') is-invalid @enderror"
                                                  value="{{ old('direccion', $perfil?->direccion) }}" maxlength="255">
                                              @error('direccion')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </fieldset> {{-- Localidad --}} <fieldset> <label class="title-user fw-7">
                                                  Localidad </label> <input type="text" name="localidad"
                                                  class="input-form @error('localidad') is-invalid @enderror"
                                                  value="{{ old('localidad', $perfil?->localidad) }}" maxlength="100">
                                              @error('localidad')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </fieldset> {{-- Provincia --}} <fieldset> <label class="title-user fw-7">
                                                  Provincia </label> <input type="text" name="provincia"
                                                  class="input-form @error('provincia') is-invalid @enderror"
                                                  value="{{ old('provincia', $perfil?->provincia) }}" maxlength="100">
                                              @error('provincia')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </fieldset> {{-- Sitio web --}} <fieldset> <label class="title-user fw-7">
                                                  Sitio web </label> <input type="url" name="sitio_web"
                                                  class="input-form @error('sitio_web') is-invalid @enderror"
                                                  value="{{ old('sitio_web', $perfil?->sitio_web) }}"
                                                  placeholder="https://..." maxlength="255"> @error('sitio_web')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </fieldset>
                                      </div>
                                  </div> {{-- ========================================== SOBRE MÍ =========================================== --}} <div class="text-editor-wrap border-bt">
                                      <h3> Sobre mí </h3>
                                      <div class="text-editor-main">
                                          <textarea name="biografia" class="form-control @error('biografia') is-invalid @enderror" rows="8"
                                              placeholder="Contanos brevemente sobre vos, tu experiencia y tus intereses profesionales...">{{ old('biografia', $perfil?->biografia) }}</textarea> @error('biografia')
                                              <div class="text-danger mt-1"> {{ $message }} </div>
                                          @enderror
                                      </div>
                                  </div> {{-- ========================================== REDES PROFESIONALES =========================================== --}} <div class="social-wrap border-bt">
                                      <h3> Redes profesionales </h3>
                                      <div class="form-social form-wg flex flat-form">
                                          <div class="form-box info-wd wg-box"> {{-- LinkedIn --}} <fieldset
                                                  class="flex2"> <span class="icon-linkedin2"></span> <input
                                                      type="url" name="linkedin"
                                                      class="input-form2 @error('linkedin') is-invalid @enderror"
                                                      placeholder="URL de LinkedIn"
                                                      value="{{ old('linkedin', $perfil?->linkedin) }}"
                                                      maxlength="255"> </fieldset> @error('linkedin')
                                                  <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror
                                          </div>
                                      </div>
                                  </div> {{-- ========================================== CV =========================================== --}} <div class="contact-wrap info-wd">
                                      <h3> Currículum Vitae </h3>
                                      <fieldset class="address-box"> <label class="title-user fw-7"> CV </label>
                                          <input type="file" name="cv"
                                              class="input-form @error('cv') is-invalid @enderror" accept=".pdf">
                                          @error('cv')
                                              <div class="text-danger mt-1"> {{ $message }} </div>
                                              @enderror @if ($perfil?->cv)
                                                  <div class="mt-2"> <a href="{{ asset('storage/' . $perfil->cv) }}"
                                                          target="_blank"> Ver CV actual </a> </div>
                                              @endif
                                          </fieldset>
                                      </div>

                                  </div>
                                  <hr>
                                  <div class="tt-button button-style right">
                                      <button type="submit" class="btn-3"> Guardar
                                          perfil </button>
                                  </div>
                              </div>

                          </form>
                      </div>
                  </div>
              </div>
          </section>

          <section class="flat-dashboard-bottom">
              <div class="themes-container">
                  <div class="row">
                      <div class="col-lg-12 col-md-12 ">
                          <h5 class="center"><?php echo date('Y'); ?> Jobtex. All Rights Reserved.</h5>
                      </div>
                  </div>
              </div>
          </section>
      </div>
