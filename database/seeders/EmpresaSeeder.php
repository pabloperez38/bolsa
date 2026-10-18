<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\User;
use App\Models\Localidad;
use App\Models\Provincia;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar la provincia Entre Ríos.
        $provincia = Provincia::where('nombre', 'Entre Ríos')
            ->firstOrFail();

        // Buscar Concordia dentro de Entre Ríos.
        $localidad = Localidad::where('nombre', 'Concordia')
            ->where('provincia_id', $provincia->id)
            ->firstOrFail();

        // ---------------------------------------------------------
        // Empresa 1 - Tech Solutions
        // ---------------------------------------------------------

        $usuario = User::where(
            'email',
            'empresa@bolsatrabajo.com'
        )->firstOrFail();

        Empresa::updateOrCreate(
            ['cuit' => '20-22222222-6'],
            [
                'user_id' => $usuario->id,
                'nombre' => 'Tech Solutions',
                'descripcion' => 'Empresa dedicada al desarrollo de soluciones de software y servicios tecnológicos.',
                'logo' => null,
                'email' => 'contacto@techsolutions.com',
                'telefono' => '0345 400-1000',
                'sitio_web' => 'https://www.techsolutions.com',
                'direccion' => 'Av. Entre Ríos 1250',
                'localidad_id' => $localidad->id,
                'activo' => true,
            ]
        );

        // ---------------------------------------------------------
        // Empresa 2 - Grupo Empresarial del Litoral
        // ---------------------------------------------------------

        $usuario = User::where(
            'email',
            'empresa.litoral@bolsatrabajo.com'
        )->firstOrFail();

        Empresa::updateOrCreate(
            ['cuit' => '20-11111111-6'],
            [
                'user_id' => $usuario->id,
                'nombre' => 'Grupo Empresarial del Litoral',
                'descripcion' => 'Organización dedicada a servicios administrativos, comerciales y financieros.',
                'logo' => null,
                'email' => 'rrhh@grupolitoral.com',
                'telefono' => '0345 400-2000',
                'sitio_web' => 'https://www.grupolitoral.com',
                'direccion' => 'Urquiza 850',
                'localidad_id' => $localidad->id,
                'activo' => true,
            ]
        );

        // ---------------------------------------------------------
        // Empresa 3 - Industria del Litoral
        // ---------------------------------------------------------

        $usuario = User::where(
            'email',
            'industria@bolsatrabajo.com'
        )->firstOrFail();

        Empresa::updateOrCreate(
            ['cuit' => '20-33333333-6'],
            [
                'user_id' => $usuario->id,
                'nombre' => 'Industria del Litoral',
                'descripcion' => 'Empresa dedicada a la producción industrial y mantenimiento de instalaciones.',
                'logo' => null,
                'email' => 'empleos@industriadellitoral.com',
                'telefono' => '0345 400-3000',
                'sitio_web' => 'https://www.industriadellitoral.com',
                'direccion' => 'Parque Industrial',
                'localidad_id' => $localidad->id,
                'activo' => true,
            ]
        );

        // ---------------------------------------------------------
        // Empresa 4 - Servicios Profesionales ER
        // ---------------------------------------------------------

        $usuario = User::where(
            'email',
            'servicios@bolsatrabajo.com'
        )->firstOrFail();

        Empresa::updateOrCreate(
            ['cuit' => '20-44444444-6'],
            [
                'user_id' => $usuario->id,
                'nombre' => 'Servicios Profesionales ER',
                'descripcion' => 'Empresa de servicios profesionales, capacitación y consultoría.',
                'logo' => null,
                'email' => 'info@servicioser.com',
                'telefono' => '0345 400-4000',
                'sitio_web' => 'https://www.servicioser.com',
                'direccion' => 'San Martín 620',
                'localidad_id' => $localidad->id,
                'activo' => true,
            ]
        );
    }
}
