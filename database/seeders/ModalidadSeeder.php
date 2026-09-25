<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use Illuminate\Database\Seeder;

class ModalidadSeeder extends Seeder
{
    public function run(): void
    {
        Modalidad::create([
            'nombre' => 'Presencial',
            'activo' => true,
        ]);

        Modalidad::create([
            'nombre' => 'Remoto',
            'activo' => true,
        ]);

        Modalidad::create([
            'nombre' => 'Híbrido',
            'activo' => true,
        ]);
    }
}
