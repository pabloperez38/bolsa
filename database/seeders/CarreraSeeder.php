<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    public function run(): void
    {
        $carreras = [
            'Ingeniería Civil',
            'Ingeniería Eléctrica',
            'Ingeniería Industrial',
            'Licenciatura en Administración Rural',
            'Tecnicatura Universitaria en Higiene y Seguridad en el Trabajo',
            'Tecnicatura Universitaria en Mantenimiento Industrial',
            'Tecnicatura Universitaria en Programación',
        ];

        foreach ($carreras as $nombre) {
            Carrera::create([
                'nombre' => $nombre,
                'activo' => true,
            ]);
        }
    }
}
