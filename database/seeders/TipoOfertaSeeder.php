<?php

namespace Database\Seeders;

use App\Models\TipoOferta;
use Illuminate\Database\Seeder;

class TipoOfertaSeeder extends Seeder
{
    /**
     * Ejecutar el seeder.
     */
    public function run(): void
    {
        TipoOferta::create([
            'nombre' => 'Trabajo',
            'activo' => true,
        ]);

        TipoOferta::create([
            'nombre' => 'Pasantía',
            'activo' => true,
        ]);
    }
}
