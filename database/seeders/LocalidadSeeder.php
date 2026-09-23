<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalidadSeeder extends Seeder
{
    public function run(): void
    {
        $localidades = [
            'Concordia',
            'Paraná',
            'Gualeguaychú',
            'Concepción del Uruguay',
            'Gualeguay',
            'Colón',
            'Federación',
            'Chajarí',
            'Villaguay',
            'La Paz',
            'Victoria',
            'Diamante',
            'Nogoyá',
            'Rosario del Tala',
            'San José',
            'San Salvador',
            'Federal',
            'Feliciano',
            'Crespo',
            'Viale',
            'María Grande',
            'Villa Elisa',
            'Villa del Rosario',
            'General Ramírez',
            'Basavilbaso',
            'Santa Elena',
            'Hernandarias',
            'Hasenkamp',
            'Bovril',
            'Cerrito',
            'San Benito',
            'Oro Verde',
            'Colonia Avellaneda',
            'Seguí',
            'Urdinarrain',
            'Larroque',
            'Pueblo Belgrano',
            'Aldea Brasilera',
            'Villa Libertador San Martín',
           
        ];

        foreach ($localidades as $localidad) {
            DB::table('localidades')->insert([
                'nombre' => $localidad,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
