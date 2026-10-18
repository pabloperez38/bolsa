<?php

namespace Database\Seeders;

use App\Models\Trabajo;
use App\Models\Empresa;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrabajoSeeder extends Seeder
{
    public function run(): void
    {
        // ==================================================
        // EMPRESAS
        // ==================================================

        $tech = Empresa::where('nombre', 'Tech Solutions')->first();
        $grupo = Empresa::where('nombre', 'Grupo Empresarial del Litoral')->first();
        $industria = Empresa::where('nombre', 'Industria del Litoral')->first();
        $servicios = Empresa::where('nombre', 'Servicios Profesionales ER')->first();

        // ==================================================
        // CATEGORÍAS
        // ==================================================

        $tecnologia = Categoria::where('nombre', 'Tecnología e Informática')->first();
        $administracion = Categoria::where('nombre', 'Administración y Finanzas')->first();
        $ingenieria = Categoria::where('nombre', 'Ingeniería')->first();
        $industriaProduccion = Categoria::where('nombre', 'Industria y Producción')->first();
        $educacion = Categoria::where('nombre', 'Educación')->first();

        // ==================================================
        // SUBCATEGORÍAS
        // ==================================================

        $desarrolloWeb = Subcategoria::where('categoria_id', $tecnologia?->id)
            ->where('nombre', 'Desarrollo Web')->first();

        $desarrolloSoftware = Subcategoria::where('categoria_id', $tecnologia?->id)
            ->where('nombre', 'Desarrollo de Software')->first();

        $soporte = Subcategoria::where('categoria_id', $tecnologia?->id)
            ->where('nombre', 'Soporte Técnico')->first();

        $administracionSub = Subcategoria::where('categoria_id', $administracion?->id)
            ->where('nombre', 'Administración')->first();

        $contabilidad = Subcategoria::where('categoria_id', $administracion?->id)
            ->where('nombre', 'Contabilidad')->first();

        $ingenieriaIndustrial = Subcategoria::where('categoria_id', $ingenieria?->id)
            ->where('nombre', 'Ingeniería Industrial')->first();

        $mantenimiento = Subcategoria::where(
            'categoria_id',
            $industriaProduccion?->id
        )->where(
            'nombre',
            'Mantenimiento Industrial'
        )->first();

        $docencia = Subcategoria::where('categoria_id', $educacion?->id)
            ->where('nombre', 'Docencia')->first();

        // ==================================================
        // VALIDAR DATOS NECESARIOS
        // ==================================================

        $requeridos = [
            'Empresa Tech Solutions' => $tech,
            'Empresa Grupo Empresarial del Litoral' => $grupo,
            'Empresa Industria del Litoral' => $industria,
            'Empresa Servicios Profesionales ER' => $servicios,
            'Categoría Tecnología e Informática' => $tecnologia,
            'Categoría Administración y Finanzas' => $administracion,
            'Categoría Ingeniería' => $ingenieria,
            'Categoría Educación' => $educacion,
            'Categoría Industria y Producción' => $industriaProduccion,
            'Subcategoría Desarrollo Web' => $desarrolloWeb,
            'Subcategoría Desarrollo de Software' => $desarrolloSoftware,
            'Subcategoría Soporte Técnico' => $soporte,
            'Subcategoría Administración' => $administracionSub,
            'Subcategoría Contabilidad' => $contabilidad,
            'Subcategoría Ingeniería Industrial' => $ingenieriaIndustrial,
            'Subcategoría Mantenimiento Industrial' => $mantenimiento,
            'Subcategoría Docencia' => $docencia,
            
        ];

        foreach ($requeridos as $nombre => $registro) {
            if (!$registro) {
                throw new \RuntimeException(
                    "No se encontró: {$nombre}. Revisá los seeders previos."
                );
            }
        }

        // ==================================================
        // DATOS DE LAS OFERTAS
        // ==================================================

        $ofertas = [
            [
                'titulo' => 'Desarrollador Web Junior',
                'descripcion' => 'Buscamos desarrollador web para incorporarse a nuestro equipo de desarrollo.',
                'empresa_id' => $tech->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $tecnologia->id,
                'subcategoria_id' => $desarrolloWeb->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 3,
                'tipo_contratacion_id' => 2,
                'fecha_publicacion' => now()->subDays(1),
                'fecha_cierre' => now()->addDays(25),
            ],
            [
                'titulo' => 'Desarrollador de Software',
                'descripcion' => 'Desarrollo y mantenimiento de aplicaciones web y sistemas empresariales.',
                'empresa_id' => $tech->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $tecnologia->id,
                'subcategoria_id' => $desarrolloSoftware->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 2,
                'tipo_contratacion_id' => 3,
                'fecha_publicacion' => now()->subDays(2),
                'fecha_cierre' => now()->addDays(20),
            ],
            [
                'titulo' => 'Técnico de Soporte IT',
                'descripcion' => 'Soporte a usuarios, mantenimiento de equipos y resolución de incidentes informáticos.',
                'empresa_id' => $tech->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $tecnologia->id,
                'subcategoria_id' => $soporte->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 2,
                'tipo_contratacion_id' => 4,
                'fecha_publicacion' => now()->subDays(3),
                'fecha_cierre' => now()->addDays(18),
            ],
            [
                'titulo' => 'Analista Administrativo',
                'descripcion' => 'Gestión administrativa, elaboración de informes y tareas de soporte al área.',
                'empresa_id' => $grupo->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $administracion->id,
                'subcategoria_id' => $administracionSub->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 3,
                'tipo_contratacion_id' => 1,
                'fecha_publicacion' => now()->subDays(4),
                'fecha_cierre' => now()->addDays(15),
            ],
            [
                'titulo' => 'Analista Contable',
                'descripcion' => 'Tareas contables, conciliaciones bancarias y preparación de informes.',
                'empresa_id' => $grupo->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $administracion->id,
                'subcategoria_id' => $contabilidad->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 1,
                'tipo_contratacion_id' => 1,
                'fecha_publicacion' => now()->subDays(5),
                'fecha_cierre' => now()->addDays(12),
            ],
            [
                'titulo' => 'Ingeniero Industrial',
                'descripcion' => 'Planificación y mejora de procesos productivos.',
                'empresa_id' => $industria->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $ingenieria->id,
                'subcategoria_id' => $ingenieriaIndustrial->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 1,
                'tipo_contratacion_id' => 1,
                'fecha_publicacion' => now()->subDays(6),
                'fecha_cierre' => now()->addDays(20),
            ],
            [
                'titulo' => 'Técnico de Mantenimiento Industrial',
                'descripcion' => 'Mantenimiento preventivo y correctivo de maquinaria industrial.',
                'empresa_id' => $industria->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $industriaProduccion->id,
                'subcategoria_id' => $mantenimiento->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 2,
                'tipo_contratacion_id' => 1,
                'fecha_publicacion' => now()->subDays(7),
                'fecha_cierre' => now()->addDays(10),
            ],
            [
                'titulo' => 'Docente de Programación',
                'descripcion' => 'Docente para cursos de programación y desarrollo de software.',
                'empresa_id' => $servicios->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $educacion->id,
                'subcategoria_id' => $docencia->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 2,
                'tipo_contratacion_id' => 2,
                'fecha_publicacion' => now()->subDays(8),
                'fecha_cierre' => now()->addDays(14),
            ],
            [
                'titulo' => 'Analista de Sistemas',
                'descripcion' => 'Análisis, documentación y seguimiento de proyectos de software.',
                'empresa_id' => $tech->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $tecnologia->id,
                'subcategoria_id' => $desarrolloSoftware->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 3,
                'tipo_contratacion_id' => 1,
                'fecha_publicacion' => now()->subDays(9),
                'fecha_cierre' => now()->addDays(16),
            ],
            [
                'titulo' => 'Asistente de Administración',
                'descripcion' => 'Asistencia en tareas administrativas y organización de documentación.',
                'empresa_id' => $servicios->id,
                'tipo_oferta_id' => 1,
                'categoria_id' => $administracion->id,
                'subcategoria_id' => $administracionSub->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 3,
                'tipo_contratacion_id' => 2,
                'fecha_publicacion' => now()->subDays(10),
                'fecha_cierre' => now()->addDays(10),
            ],
            [
                'titulo' => 'Pasantía en Desarrollo Web',
                'descripcion' => 'Pasantía destinada a estudiantes interesados en adquirir experiencia en desarrollo web.',
                'empresa_id' => $tech->id,
                'tipo_oferta_id' => 2,
                'categoria_id' => $tecnologia->id,
                'subcategoria_id' => $desarrolloWeb->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 3,
                'tipo_contratacion_id' => 2,
                'fecha_publicacion' => now(),
                'fecha_cierre' => now()->addDays(30),
            ],
            [
                'titulo' => 'Pasantía en Administración',
                'descripcion' => 'Pasantía para estudiantes interesados en adquirir experiencia en tareas administrativas.',
                'empresa_id' => $grupo->id,
                'tipo_oferta_id' => 2,
                'categoria_id' => $administracion->id,
                'subcategoria_id' => $administracionSub->id,
                'ubicacion' => 'Concordia, Entre Ríos',
                'modalidad_id' => 1,
                'tipo_contratacion_id' => 2,
                'fecha_publicacion' => now(),
                'fecha_cierre' => now()->addDays(30),
            ],
        ];

        // ==================================================
        // CREAR OFERTAS
        // ==================================================

        foreach ($ofertas as $oferta) {
            $oferta['slug'] = Str::slug($oferta['titulo']);
            $oferta['activo'] = true;

            Trabajo::create($oferta);
        }
    }
}
