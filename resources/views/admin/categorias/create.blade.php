@extends('admin.layouts.app')

@section('title', 'Crear categoría')

@section('content')

    @include('admin.components.header')

    @include('admin.components.leftmenu')

    <div class="dashboard__content">

        <section class="page-title-dashboard">
            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="title-dashboard">
                            <div class="title-dash flex2">Crear Categoría</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flat-dashboard-setting flat-dashboard-setting2">

            <div class="themes-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 ">

                        <div class="applicants bg-white">
                            <form action="{{ route('admin.categorias.store') }}" method="POST">

                                @csrf

                                <div class="profile-setting bg-white">

                                    <div class="form-infor-profile">

                                        <div class="form-infor flex flat-form">

                                            <div class="info-box info-wd">

                                                <fieldset>

                                                    <label class="title-user fw-7">
                                                        Nombre categoría
                                                    </label>

                                                    <input type="text" name="nombre"
                                                        class="input-form @error('nombre') is-invalid @enderror"
                                                        value="{{ old('nombre') }}" maxlength="255" required>

                                                    @error('nombre')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </fieldset>

                                            </div>

                                        </div>

                                        <div class="text-editor-wrap border-bt">

                                            <label class="title-user fw-7">
                                                Descripción
                                            </label>

                                            <div class="text-editor-main">

                                                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="8"
                                                    placeholder="Descripción">{{ old('descripcion') }}</textarea>

                                                @error('descripcion')
                                                    <div class="text-danger mt-1">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>

                                        </div>

                                        <div class="tt-button button-style right">

                                            <button type="submit" class="btn-3">
                                                Guardar categoría <i class="fa-solid fa-floppy-disk"></i>
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
