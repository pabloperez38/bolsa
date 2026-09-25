<?php

namespace Database\Seeders;

use App\Models\TipoContratacion;
use Illuminate\Database\Seeder;

class TipoContratacionSeeder extends Seeder
{
    public function run(): void
    {
        TipoContratacion::create([
            'nombre' => 'Full-time',
            'activo' => true,
        ]);

        TipoContratacion::create([
            'nombre' => 'Part-time',
            'activo' => true,
        ]);

        TipoContratacion::create([
            'nombre' => 'Freelance',
            'activo' => true,
        ]);

        TipoContratacion::create([
            'nombre' => 'Temporal',
            'activo' => true,
        ]);

        TipoContratacion::create([
            'nombre' => 'Por proyecto',
            'activo' => true,
        ]);
    }
}
