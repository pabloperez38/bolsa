<?php

namespace Tests\Feature;

use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function createUserWithRole(string $roleName): User
    {
        $tipo = TipoUsuario::firstOrCreate(
            ['nombre' => $roleName],
            ['descripcion' => $roleName]
        );

        return User::factory()->create([
            'tipo_usuario_id' => $tipo->id,
        ]);
    }

    public function test_admin_can_access_admin_panel(): void
    {
        $admin = $this->createUserWithRole('administrador');

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk();
    }

    public function test_regular_user_cannot_access_admin_panel(): void
    {
        $usuario = $this->createUserWithRole('estudiante');

        $this->actingAs($usuario)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_organization_can_access_organization_dashboard(): void
    {
        $Empresa = $this->createUserWithRole('Empresa');

        $this->actingAs($Empresa)
            ->get('/Empresa')
            ->assertOk();
    }

    public function test_user_can_access_user_dashboard(): void
    {
        $usuario = $this->createUserWithRole('estudiante');

        $this->actingAs($usuario)
            ->get('/usuario')
            ->assertOk();
    }
}
