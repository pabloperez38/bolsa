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
                'nombre' => 'docente',
                'descripcion' => 'Docentes de la universidad',
            ],
            [
                'nombre' => 'empresa',
                'descripcion' => 'Usuario perteneciente a una empresa',
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
