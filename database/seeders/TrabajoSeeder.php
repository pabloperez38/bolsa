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
        $tech = Organizacion::where('nombre', 'Tech Solutions')->first();
        $grupo = Organizacion::where('nombre', 'Grupo Empresarial del Litoral')->first();
        $industria = Organizacion::where('nombre', 'Industria del Litoral')->first();
        $servicios = Organizacion::where('nombre', 'Servicios Profesionales ER')->first();

        $tecnologia = Categoria::where('nombre', 'Tecnología e Informática')->first();
        $administracion = Categoria::where('nombre', 'Administración y Finanzas')->first();
        $ingenieria = Categoria::where('nombre', 'Ingeniería')->first();
        $educacion = Categoria::where('nombre', 'Educación')->first();

        $desarrolloWeb = Subcategoria::where('nombre', 'Desarrollo Web')->first();
        $desarrolloSoftware = Subcategoria::where('nombre', 'Desarrollo de Software')->first();
        $soporte = Subcategoria::where('nombre', 'Soporte Técnico')->first();
        $administracionSub = Subcategoria::where('nombre', 'Administración')->first();
        $contabilidad = Subcategoria::where('nombre', 'Contabilidad')->first();
        $ingenieriaIndustrial = Subcategoria::where('nombre', 'Ingeniería Industrial')->first();
        $mantenimiento = Subcategoria::where('nombre', 'Mantenimiento Industrial')->first();
        $docencia = Subcategoria::where('nombre', 'Docencia')->first();

        Trabajo::create([
            'titulo' => 'Desarrollador Web Junior',
            'descripcion' => 'Buscamos desarrollador web para incorporarse a nuestro equipo de desarrollo.',
            'organizacion_id' => $tech->id,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $desarrolloWeb->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Híbrido',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 650000,
            'salario_maximo' => 850000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(1),
            'fecha_cierre' => now()->addDays(25),
            'destacado' => true,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Desarrollador de Software',
            'descripcion' => 'Desarrollo y mantenimiento de aplicaciones web y sistemas empresariales.',
            'organizacion_id' => $tech->id,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $desarrolloSoftware->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Remoto',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 900000,
            'salario_maximo' => 1300000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(2),
            'fecha_cierre' => now()->addDays(20),
            'destacado' => true,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Técnico de Soporte IT',
            'descripcion' => 'Soporte a usuarios, mantenimiento de equipos y resolución de incidentes informáticos.',
            'organizacion_id' => $tech->id,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $soporte->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Presencial',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 550000,
            'salario_maximo' => 750000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(3),
            'fecha_cierre' => now()->addDays(18),
            'destacado' => false,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Analista Administrativo',
            'descripcion' => 'Gestión administrativa, elaboración de informes y tareas de soporte al área.',
            'organizacion_id' => $grupo->id,
            'categoria_id' => $administracion->id,
            'subcategoria_id' => $administracionSub->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Presencial',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 600000,
            'salario_maximo' => 800000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(4),
            'fecha_cierre' => now()->addDays(15),
            'destacado' => true,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Analista Contable',
            'descripcion' => 'Tareas contables, conciliaciones bancarias y preparación de informes.',
            'organizacion_id' => $grupo->id,
            'categoria_id' => $administracion->id,
            'subcategoria_id' => $contabilidad->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Híbrido',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 700000,
            'salario_maximo' => 950000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(5),
            'fecha_cierre' => now()->addDays(12),
            'destacado' => false,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Ingeniero Industrial',
            'descripcion' => 'Planificación y mejora de procesos productivos.',
            'organizacion_id' => $industria->id,
            'categoria_id' => $ingenieria->id,
            'subcategoria_id' => $ingenieriaIndustrial->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Presencial',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 1000000,
            'salario_maximo' => 1500000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(6),
            'fecha_cierre' => now()->addDays(20),
            'destacado' => true,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Técnico de Mantenimiento Industrial',
            'descripcion' => 'Mantenimiento preventivo y correctivo de maquinaria industrial.',
            'organizacion_id' => $industria->id,
            'categoria_id' => $ingenieria->id,
            'subcategoria_id' => $mantenimiento->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Presencial',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 650000,
            'salario_maximo' => 900000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(7),
            'fecha_cierre' => now()->addDays(10),
            'destacado' => false,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Docente de Programación',
            'descripcion' => 'Docente para cursos de programación y desarrollo de software.',
            'organizacion_id' => $servicios->id,
            'categoria_id' => $educacion->id,
            'subcategoria_id' => $docencia->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Híbrido',
            'tipo_contratacion' => 'Part-time',
            'salario_minimo' => 450000,
            'salario_maximo' => 650000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(8),
            'fecha_cierre' => now()->addDays(14),
            'destacado' => false,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Analista de Sistemas',
            'descripcion' => 'Análisis, documentación y seguimiento de proyectos de software.',
            'organizacion_id' => $tech->id,
            'categoria_id' => $tecnologia->id,
            'subcategoria_id' => $desarrolloSoftware->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Remoto',
            'tipo_contratacion' => 'Full-time',
            'salario_minimo' => 850000,
            'salario_maximo' => 1200000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(9),
            'fecha_cierre' => now()->addDays(16),
            'destacado' => true,
            'activo' => true,
        ]);

        Trabajo::create([
            'titulo' => 'Asistente de Administración',
            'descripcion' => 'Asistencia en tareas administrativas y organización de documentación.',
            'organizacion_id' => $servicios->id,
            'categoria_id' => $administracion->id,
            'subcategoria_id' => $administracionSub->id,
            'ubicacion' => 'Concordia, Entre Ríos',
            'modalidad' => 'Presencial',
            'tipo_contratacion' => 'Part-time',
            'salario_minimo' => 400000,
            'salario_maximo' => 550000,
            'moneda' => 'ARS',
            'fecha_publicacion' => now()->subDays(10),
            'fecha_cierre' => now()->addDays(10),
            'destacado' => false,
            'activo' => true,
        ]);
    }
}