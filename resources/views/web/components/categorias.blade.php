{{-- =====================================================
     CATEGORÍAS Y SUBCATEGORÍAS
===================================================== --}}

<section class="categorias-section">
    <div class="tf-container">

        {{-- Encabezado --}}
        <div class="categorias-heading">
            <span class="categorias-kicker">
                <span class="categorias-kicker-dot"></span>
                EXPLORÁ TUS POSIBILIDADES
            </span>

            <h2>Encontrá tu próximo desafío</h2>

            <p>
                Explorá las áreas profesionales, descubrí especialidades
                y encontrá oportunidades que se adapten a tu perfil.
            </p>
        </div>

        {{-- Grilla de categorías --}}
        <div class="categorias-grid">

            @foreach ($categorias as $categoria)
                <article class="categoria-card">

                    {{-- Cabecera de la tarjeta --}}
                    <div class="categoria-card-header">

                        <div class="categoria-icono">
                            <span class="{{ $categoria->icono }}"></span>
                        </div>

                        <div class="categoria-card-titulo">
                            <h3>
                                <a href="{{ route('web.categorias.show', [
                                    'slug' => $categoria->slug
                                ]) }}">
                                    {{ $categoria->nombre }}
                                </a>
                            </h3>

                            <span class="categoria-cantidad">
                                {{ $categoria->subcategorias->count() }}
                                {{ $categoria->subcategorias->count() === 1
                                    ? 'especialidad'
                                    : 'especialidades' }}
                            </span>
                        </div>

                        <a
                            href="{{ route('web.categorias.show', [
                                'slug' => $categoria->slug
                            ]) }}"
                            class="categoria-flecha"
                            aria-label="Explorar {{ $categoria->nombre }}"
                        >
                            <span class="icon-keyboard_arrow_right"></span>
                        </a>
                    </div>

                    {{-- Descripción --}}
                    @if ($categoria->descripcion)
                        <p class="categoria-descripcion">
                            {{ $categoria->descripcion }}
                        </p>
                    @endif

                    {{-- Subcategorías --}}
                    <div class="categoria-subcategorias">
                        @forelse ($categoria->subcategorias as $subcategoria)
                            <a
                                href="{{ route('web.ofertas.subcategoria', [
                                    'categoriaSlug' => $categoria->slug,
                                    'subcategoriaSlug' => $subcategoria->slug,
                                ]) }}"
                                class="categoria-chip"
                            >
                                {{ $subcategoria->nombre }}
                                <span class="icon-keyboard_arrow_right"></span>
                            </a>
                        @empty
                            <span class="categoria-sin-subcategorias">
                                Próximamente nuevas especialidades.
                            </span>
                        @endforelse
                    </div>

                    {{-- Pie --}}
                    <div class="categoria-card-footer">
                        <a
                            href="{{ route('web.categorias.show', [
                                'slug' => $categoria->slug
                            ]) }}"
                        >
                            Explorar área profesional
                            <span class="icon-keyboard_arrow_right"></span>
                        </a>
                    </div>

                </article>
            @endforeach

        </div>

        {{-- Acción general --}}
        <div class="categorias-acciones">
            <a href="{{ route('web.ofertas.index') }}" class="tf-button style-1">
                Explorar todas las ofertas
                <span class="icon-keyboard_arrow_right"></span>
            </a>
        </div>

    </div>
</section>