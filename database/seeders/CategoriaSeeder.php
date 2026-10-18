<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Carga las categorías principales de la Bolsa de Trabajo.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Tecnología e Informática',
                'slug' => Str::slug('Tecnología e Informática'),
                'descripcion' => 'Desarrollo de software, infraestructura, soporte y servicios tecnológicos.',
                'icono' => 'icon-categorie-1',
                'activo' => true,
            ],
            [
                'nombre' => 'Administración y Finanzas',
                'slug' => Str::slug('Administración y Finanzas'),
                'descripcion' => 'Administración, contabilidad, finanzas y gestión empresarial.',
                'icono' => 'icon-categorie-2',
                'activo' => true,
            ],
            [
                'nombre' => 'Marketing y Comunicación',
                'slug' => Str::slug('Marketing y Comunicación'),
                'descripcion' => 'Marketing, comunicación institucional, publicidad y contenidos.',
                'icono' => 'icon-categorie-3',
                'activo' => true,
            ],
            [
                'nombre' => 'Diseño y Creatividad',
                'slug' => Str::slug('Diseño y Creatividad'),
                'descripcion' => 'Diseño gráfico, diseño digital, multimedia y producción creativa.',
                'icono' => 'icon-categorie-4',
                'activo' => true,
            ],
            [
                'nombre' => 'Ingeniería',
                'slug' => Str::slug('Ingeniería'),
                'descripcion' => 'Ingeniería, proyectos, procesos y servicios técnicos especializados.',
                'icono' => 'icon-categorie-5',
                'activo' => true,
            ],
            [
                'nombre' => 'Salud',
                'slug' => Str::slug('Salud'),
                'descripcion' => 'Profesionales, técnicos y servicios relacionados con el área de salud.',
                'icono' => 'icon-categorie-6',
                'activo' => true,
            ],
            [
                'nombre' => 'Educación',
                'slug' => Str::slug('Educación'),
                'descripcion' => 'Docencia, capacitación, formación y servicios educativos.',
                'icono' => 'icon-categorie-7',
                'activo' => true,
            ],
            [
                'nombre' => 'Comercio y Ventas',
                'slug' => Str::slug('Comercio y Ventas'),
                'descripcion' => 'Ventas, comercialización, atención al cliente y desarrollo de negocios.',
                'icono' => 'icon-categorie-8',
                'activo' => true,
            ],
            [
                'nombre' => 'Industria y Producción',
                'slug' => Str::slug('Industria y Producción'),
                'descripcion' => 'Producción, manufactura, mantenimiento y gestión industrial.',
                'icono' => 'icon-categorie-9',
                'activo' => true,
            ],
            [
                'nombre' => 'Logística y Transporte',
                'slug' => Str::slug('Logística y Transporte'),
                'descripcion' => 'Logística, distribución, transporte y gestión de operaciones.',
                'icono' => 'icon-categorie-10',
                'activo' => true,
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nombre' => $categoria['nombre']],
                $categoria
            );
        }
    }
}
