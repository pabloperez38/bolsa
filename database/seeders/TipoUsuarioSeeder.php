<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            [
                'nombre' => 'administrador',
                'descripcion' => 'Administrador de la plataforma',
            ],
            [
                'nombre' => 'estudiante',
                'descripcion' => 'Estudiante de la universidad',
            ],
            [
                'nombre' => 'graduado',
                'descripcion' => 'Graduado o exalumno de la universidad',
            ],
            [
                'nombre' => 'personal',
                'descripcion' => 'Personal de la universidad',
            ],
            [
                'nombre' => 'organizacion',
                'descripcion' => 'Usuario perteneciente a una organización',
            ],
        ];

        foreach ($tipos as $tipo) {
            TipoUsuario::updateOrCreate(
                ['nombre' => $tipo['nombre']],
                $tipo
            );
        }
    }
}
