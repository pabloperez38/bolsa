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

        // Administrador
        User::updateOrCreate(
            ['email' => 'admin@bolsatrabajo.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['administrador'],
            ]
        );

        // Estudiante
        User::updateOrCreate(
            ['email' => 'estudiante@bolsatrabajo.com'],
            [
                'name' => 'Juan Estudiante',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['estudiante'],
            ]
        );

        // Graduado
        User::updateOrCreate(
            ['email' => 'graduado@bolsatrabajo.com'],
            [
                'name' => 'María Graduada',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['graduado'],
            ]
        );

        // Docente
        User::updateOrCreate(
            ['email' => 'docente@bolsatrabajo.com'],
            [
                'name' => 'Carlos Docente',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['docente'],
            ]
        );

        // Empresa - Tech Solutions
        User::updateOrCreate(
            ['email' => 'empresa@bolsatrabajo.com'],
            [
                'name' => 'Tech Solutions',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['empresa'],
            ]
        );

        // Empresa - Grupo Empresarial del Litoral
        User::updateOrCreate(
            ['email' => 'empresa.litoral@bolsatrabajo.com'],
            [
                'name' => 'Grupo Empresarial del Litoral',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['empresa'],
            ]
        );

        // Empresa - Industria del Litoral
        User::updateOrCreate(
            ['email' => 'industria@bolsatrabajo.com'],
            [
                'name' => 'Industria del Litoral',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['empresa'],
            ]
        );

        // Empresa - Servicios Profesionales ER
        User::updateOrCreate(
            ['email' => 'servicios@bolsatrabajo.com'],
            [
                'name' => 'Servicios Profesionales ER',
                'password' => Hash::make('12345678'),
                'tipo_usuario_id' => $tipos['empresa'],
            ]
        );
    }
}
