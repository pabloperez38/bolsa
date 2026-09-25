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
            CategoriaSeeder::class,
            SubcategoriaSeeder::class,
            OrganizacionSeeder::class,
            TipoUsuarioSeeder::class,
            UserSeeder::class,
            LocalidadSeeder::class,
            TipoOfertaSeeder::class,
            ModalidadSeeder::class,
            TipoContratacionSeeder::class,
            TrabajoSeeder::class,

        ]);
        // User::factory(10)->create();

        /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
