<?php

namespace Database\Seeders;

use App\Models\Trabajo;
use App\Models\Organizacion;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Seeder;

class TrabajoSeeder extends Seeder
{
    public function run(): void
    {
        // ==================================================
        // ORGANIZACIONES
        // ==================================================

        $tech = Organizacion::where('nombre', 'Tech Solutions')->first();
        $grupo = Organizacion::where('nombre', 'Grupo Empresarial del Litoral')->first();
        $industria = Organizacion::where('nombre', 'Industria del Litoral')->first();
        $servicios = Organizacion::where('nombre', 'Servicios Profesionales ER')->first();

        // ==================================================
        // CATEGORÍAS
        // ==================================================

        $tecnologia = Categoria::where('nombre', 'Tecnología e Informática')->first();
        $administracion = Categoria::where('nombre', 'Administración y Finanzas')->first();
        $ingenieria = Categoria::where('nombre', 'Ingeniería')->first();
        $educacion = Categoria::where('nombre', 'Educación')->first();

        // ==================================================
        // SUBCATEGORÍAS
        // ==================================================

        $desarrolloWeb = Subcategoria::where('nombre', 'Desarrollo Web')->first();
        $desarrolloSoftware = Subcategoria::where('nombre', 'Desarrollo de Software')->first();
        $soporte = Subcategoria::where('nombre', 'Soporte Técnico')->first();
        $administracionSub = Subcategoria::where('nombre', 'Administración')->first();
        $contabilidad = Subcategoria::where('nombre', 'Contabilidad')->first();
        $ingenieriaIndustrial = Subcategoria::where('nombre', 'Ingeniería Industrial')->first();
        $mantenimiento = Subcategoria::where('nombre', 'Mantenimiento Industrial')->first();
        $docencia = Subcategoria::where('nombre', 'Docencia')->first();

        // ==================================================
        // TIPOS DE OFERTA
        // ==================================================
        // 1 = Trabajo
        // 2 = Pasantía

        // ==================================================
        // MODALIDADES
        // ==================================================
        // 1 = Presencial
        // 2 = Remoto
        // 3 = Híbrido

        // ==================================================
        // TIPOS DE CONTRATACIÓN
        // ==================================================
        // 1 = Full-time
        // 2 = Part-time
        // 3 = Freelance
        // 4 = Temporal
        // 5 = Por proyecto


        // ==================================================
        // 1. TRABAJO - DESARROLLADOR WEB JUNIOR
        // ==================================================

        Trabajo::create([
            'titulo' => 'Desarrollador Web Junior',
            'descripcion' => 'Buscamos desarrollador web para incorporarse a nuestro equipo de desarrollo.',
            'organizacion_id' => $tech->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $desarrolloWeb->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 3,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(1),
            'fecha_cierre' => now()->addDays(25),
            'activo' => true,
        ]);


        // ==================================================
        // 2. TRABAJO - DESARROLLADOR DE SOFTWARE
        // ==================================================

        Trabajo::create([
            'titulo' => 'Desarrollador de Software',
            'descripcion' => 'Desarrollo y mantenimiento de aplicaciones web y sistemas empresariales.',
            'organizacion_id' => $tech->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $desarrolloSoftware->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 2,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(2),
            'fecha_cierre' => now()->addDays(20),
            'activo' => true,
        ]);


        // ==================================================
        // 3. TRABAJO - TÉCNICO DE SOPORTE IT
        // ==================================================

        Trabajo::create([
            'titulo' => 'Técnico de Soporte IT',
            'descripcion' => 'Soporte a usuarios, mantenimiento de equipos y resolución de incidentes informáticos.',
            'organizacion_id' => $tech->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $soporte->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 2,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(3),
            'fecha_cierre' => now()->addDays(18),
            'activo' => true,
        ]);


        // ==================================================
        // 4. TRABAJO - ANALISTA ADMINISTRATIVO
        // ==================================================

        Trabajo::create([
            'titulo' => 'Analista Administrativo',
            'descripcion' => 'Gestión administrativa, elaboración de informes y tareas de soporte al área.',
            'organizacion_id' => $grupo->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $administracion->id,
            'subcategoria_id' => $administracionSub->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 3,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(4),
            'fecha_cierre' => now()->addDays(15),
            'activo' => true,
        ]);


        // ==================================================
        // 5. TRABAJO - ANALISTA CONTABLE
        // ==================================================

        Trabajo::create([
            'titulo' => 'Analista Contable',
            'descripcion' => 'Tareas contables, conciliaciones bancarias y preparación de informes.',
            'organizacion_id' => $grupo->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $administracion->id,
            'subcategoria_id' => $contabilidad->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 1,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(5),
            'fecha_cierre' => now()->addDays(12),
            'activo' => true,
        ]);


        // ==================================================
        // 6. TRABAJO - INGENIERO INDUSTRIAL
        // ==================================================

        Trabajo::create([
            'titulo' => 'Ingeniero Industrial',
            'descripcion' => 'Planificación y mejora de procesos productivos.',
            'organizacion_id' => $industria->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $ingenieria->id,
            'subcategoria_id' => $ingenieriaIndustrial->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 1,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(6),
            'fecha_cierre' => now()->addDays(20),
            'activo' => true,
        ]);


        // ==================================================
        // 7. TRABAJO - TÉCNICO DE MANTENIMIENTO INDUSTRIAL
        // ==================================================

        Trabajo::create([
            'titulo' => 'Técnico de Mantenimiento Industrial',
            'descripcion' => 'Mantenimiento preventivo y correctivo de maquinaria industrial.',
            'organizacion_id' => $industria->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $ingenieria->id,
            'subcategoria_id' => $mantenimiento->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 2,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(7),
            'fecha_cierre' => now()->addDays(10),
            'activo' => true,
        ]);


        // ==================================================
        // 8. TRABAJO - DOCENTE DE PROGRAMACIÓN
        // ==================================================

        Trabajo::create([
            'titulo' => 'Docente de Programación',
            'descripcion' => 'Docente para cursos de programación y desarrollo de software.',
            'organizacion_id' => $servicios->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $educacion->id,
            'subcategoria_id' => $docencia->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 2,
            'tipo_contratacion_id' => 2,
            'fecha_publicacion' => now()->subDays(8),
            'fecha_cierre' => now()->addDays(14),
            'activo' => true,
        ]);


        // ==================================================
        // 9. TRABAJO - ANALISTA DE SISTEMAS
        // ==================================================

        Trabajo::create([
            'titulo' => 'Analista de Sistemas',
            'descripcion' => 'Análisis, documentación y seguimiento de proyectos de software.',
            'organizacion_id' => $tech->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $desarrolloSoftware->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 3,
            'tipo_contratacion_id' => 1,
            'fecha_publicacion' => now()->subDays(9),
            'fecha_cierre' => now()->addDays(16),
            'activo' => true,
        ]);


        // ==================================================
        // 10. TRABAJO - ASISTENTE DE ADMINISTRACIÓN
        // ==================================================

        Trabajo::create([
            'titulo' => 'Asistente de Administración',
            'descripcion' => 'Asistencia en tareas administrativas y organización de documentación.',
            'organizacion_id' => $servicios->id,
            'tipo_oferta_id' => 1,
            'categoria_id' => $administracion->id,
            'subcategoria_id' => $administracionSub->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 3,
            'tipo_contratacion_id' => 2,
            'fecha_publicacion' => now()->subDays(10),
            'fecha_cierre' => now()->addDays(10),
            'activo' => true,
        ]);


        // ==================================================
        // 11. PASANTÍA - DESARROLLO WEB
        // ==================================================

        Trabajo::create([
            'titulo' => 'Pasantía en Desarrollo Web',
            'descripcion' => 'Pasantía destinada a estudiantes interesados en adquirir experiencia en desarrollo web.',
            'organizacion_id' => $tech->id,
            'tipo_oferta_id' => 2,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $desarrolloWeb->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 3,
            'tipo_contratacion_id' => 2,
            'fecha_publicacion' => now(),
            'fecha_cierre' => now()->addDays(30),
            'activo' => true,
        ]);


        // ==================================================
        // 12. PASANTÍA - ADMINISTRACIÓN
        // ==================================================

        Trabajo::create([
            'titulo' => 'Pasantía en Administración',
            'descripcion' => 'Pasantía para estudiantes interesados en adquirir experiencia en tareas administrativas.',
            'organizacion_id' => $grupo->id,
            'tipo_oferta_id' => 2,
            'categoria_id' => $administracion->id,
            'subcategoria_id' => $administracionSub->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad_id' => 1,
            'tipo_contratacion_id' => 2,
            'fecha_publicacion' => now(),
            'fecha_cierre' => now()->addDays(30),
            'activo' => true,
        ]);
    }
}
