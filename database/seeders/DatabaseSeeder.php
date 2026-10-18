<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinciaSeeder::class,
            LocalidadSeeder::class,
            CarreraSeeder::class,
            CategoriaSeeder::class,
            SubcategoriaSeeder::class,
            TipoUsuarioSeeder::class,
            UserSeeder::class,
            EmpresaSeeder::class,
            TipoOfertaSeeder::class,
            ModalidadSeeder::class,
            TipoContratacionSeeder::class,
            TrabajoSeeder::class,
            PersonaInstitucionalSeeder::class,

        ]);
        // User::factory(10)->create();

        /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
