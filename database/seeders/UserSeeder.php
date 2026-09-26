<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TipoUsuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = TipoUsuario::pluck('id', 'nombre');

        User::updateOrCreate(
            ['email' => 'admin@bolsatrabajo.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['administrador'],
            ]
        );

        User::updateOrCreate(
            ['email' => 'estudiante@bolsatrabajo.com'],
            [
                'name' => 'Juan Estudiante',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['estudiante'],
            ]
        );

        User::updateOrCreate(
            ['email' => 'graduado@bolsatrabajo.com'],
            [
                'name' => 'María Graduada',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['graduado'],
            ]
        );

        User::updateOrCreate(
            ['email' => 'docente@bolsatrabajo.com'],
            [
                'name' => 'Carlos Docente',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['docente'],
            ]
        );

        User::updateOrCreate(
            ['email' => 'empresa@bolsatrabajo.com'],
            [
                'name' => 'Tech Solutions',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['empresa'],
            ]
        );
    }
}
