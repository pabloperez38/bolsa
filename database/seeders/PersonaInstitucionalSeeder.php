<?php

namespace Database\Seeders;

use App\Models\PersonaInstitucional;
use Illuminate\Database\Seeder;

class PersonaInstitucionalSeeder extends Seeder
{
    public function run(): void
    {
        $personas = [

            // =====================================================
            // INGENIERÍA CIVIL
            // =====================================================

            [
                'dni' => '40123456',
                'legajo' => '10001',
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'tipo' => 'estudiante',
                'carrera' => 'Ingeniería Civil',
                'materias_aprobadas' => 12,
                'activo' => true,
            ],

            [
                'dni' => '40234567',
                'legajo' => '10002',
                'nombre' => 'María',
                'apellido' => 'Gómez',
                'tipo' => 'estudiante',
                'carrera' => 'Ingeniería Civil',
                'materias_aprobadas' => 22,
                'activo' => true,
            ],

            // =====================================================
            // INGENIERÍA ELÉCTRICA
            // =====================================================

            [
                'dni' => '40345678',
                'legajo' => '11001',
                'nombre' => 'Carlos',
                'apellido' => 'Rodríguez',
                'tipo' => 'estudiante',
                'carrera' => 'Ingeniería Eléctrica',
                'materias_aprobadas' => 16,
                'activo' => true,
            ],

            [
                'dni' => '40456789',
                'legajo' => '11002',
                'nombre' => 'Laura',
                'apellido' => 'Fernández',
                'tipo' => 'estudiante',
                'carrera' => 'Ingeniería Eléctrica',
                'materias_aprobadas' => 27,
                'activo' => true,
            ],

            // =====================================================
            // INGENIERÍA INDUSTRIAL
            // =====================================================

            [
                'dni' => '40567890',
                'legajo' => '12001',
                'nombre' => 'Martín',
                'apellido' => 'López',
                'tipo' => 'estudiante',
                'carrera' => 'Ingeniería Industrial',
                'materias_aprobadas' => 20,
                'activo' => true,
            ],

            [
                'dni' => '40678901',
                'legajo' => '12002',
                'nombre' => 'Sofía',
                'apellido' => 'Martínez',
                'tipo' => 'estudiante',
                'carrera' => 'Ingeniería Industrial',
                'materias_aprobadas' => 31,
                'activo' => true,
            ],

            // =====================================================
            // LICENCIATURA EN ADMINISTRACIÓN RURAL
            // =====================================================

            [
                'dni' => '40789012',
                'legajo' => '13001',
                'nombre' => 'Federico',
                'apellido' => 'Sánchez',
                'tipo' => 'estudiante',
                'carrera' => 'Licenciatura en Administración Rural',
                'materias_aprobadas' => 10,
                'activo' => true,
            ],

            [
                'dni' => '40890123',
                'legajo' => '13002',
                'nombre' => 'Valentina',
                'apellido' => 'Díaz',
                'tipo' => 'estudiante',
                'carrera' => 'Licenciatura en Administración Rural',
                'materias_aprobadas' => 24,
                'activo' => true,
            ],

            // =====================================================
            // TECNICATURA UNIVERSITARIA EN HIGIENE Y SEGURIDAD
            // =====================================================

            [
                'dni' => '40901234',
                'legajo' => '14001',
                'nombre' => 'Diego',
                'apellido' => 'Acosta',
                'tipo' => 'estudiante',
                'carrera' => 'Tecnicatura Universitaria en Higiene y Seguridad en el Trabajo',
                'materias_aprobadas' => 8,
                'activo' => true,
            ],

            [
                'dni' => '41012345',
                'legajo' => '14002',
                'nombre' => 'Camila',
                'apellido' => 'Romero',
                'tipo' => 'estudiante',
                'carrera' => 'Tecnicatura Universitaria en Higiene y Seguridad en el Trabajo',
                'materias_aprobadas' => 15,
                'activo' => true,
            ],

            // =====================================================
            // TECNICATURA UNIVERSITARIA EN MANTENIMIENTO INDUSTRIAL
            // =====================================================

            [
                'dni' => '41123456',
                'legajo' => '15001',
                'nombre' => 'Nicolás',
                'apellido' => 'Torres',
                'tipo' => 'estudiante',
                'carrera' => 'Tecnicatura Universitaria en Mantenimiento Industrial',
                'materias_aprobadas' => 7,
                'activo' => true,
            ],

            [
                'dni' => '41234567',
                'legajo' => '15002',
                'nombre' => 'Lucía',
                'apellido' => 'Herrera',
                'tipo' => 'estudiante',
                'carrera' => 'Tecnicatura Universitaria en Mantenimiento Industrial',
                'materias_aprobadas' => 13,
                'activo' => true,
            ],

            // =====================================================
            // TECNICATURA UNIVERSITARIA EN PROGRAMACIÓN
            // =====================================================

            [
                'dni' => '41345678',
                'legajo' => '16001',
                'nombre' => 'Pablo',
                'apellido' => 'García',
                'tipo' => 'estudiante',
                'carrera' => 'Tecnicatura Universitaria en Programación',
                'materias_aprobadas' => 5,
                'activo' => true,
            ],

            [
                'dni' => '41456789',
                'legajo' => '16002',
                'nombre' => 'Ana',
                'apellido' => 'Molina',
                'tipo' => 'estudiante',
                'carrera' => 'Tecnicatura Universitaria en Programación',
                'materias_aprobadas' => 10,
                'activo' => true,
            ],

            [
                'dni' => '41567890',
                'legajo' => '16003',
                'nombre' => 'Lucas',
                'apellido' => 'Vega',
                'tipo' => 'graduado',
                'carrera' => 'Tecnicatura Universitaria en Programación',
                'materias_aprobadas' => 8,
                'activo' => true,
            ],

            // =====================================================
            // DOCENTES
            // =====================================================

            [
                'dni' => '30123456',
                'legajo' => '50001',
                'nombre' => 'Roberto',
                'apellido' => 'Fernández',
                'tipo' => 'docente',
                'carrera' => null,
                'materias_aprobadas' => 0,
                'activo' => true,
            ],

            [
                'dni' => '31234567',
                'legajo' => '50002',
                'nombre' => 'Patricia',
                'apellido' => 'Gómez',
                'tipo' => 'docente',
                'carrera' => null,
                'materias_aprobadas' => 0,
                'activo' => true,
            ], 
            [
                'dni' => '27529355',
                'legajo' => '92452',
                'nombre' => 'Pablo',
                'apellido' => 'Pérez',
                'tipo' => 'docente',
                'carrera' => null,
                'materias_aprobadas' => 0,
                'activo' => true,
            ],
        ];

        foreach ($personas as $persona) {
            PersonaInstitucional::create($persona);
        }
    }
}