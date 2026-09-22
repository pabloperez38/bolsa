<?php

namespace Database\Seeders;

use App\Models\Organizacion;
use Illuminate\Database\Seeder;

class OrganizacionSeeder extends Seeder
{
    public function run(): void
    {
        Organizacion::create([
            'nombre' => 'Tech Solutions',
            'descripcion' => 'Empresa dedicada al desarrollo de soluciones de software y servicios tecnológicos.',
            'logo' => null,
            'email' => 'contacto@techsolutions.com',
            'telefono' => '0345 400-1000',
            'sitio_web' => 'https://www.techsolutions.com',
            'direccion' => 'Av. Entre Ríos 1250',
            'localidad' => 'Concordia',
            'provincia' => 'Entre Ríos',
            'activo' => true,
        ]);

        Organizacion::create([
            'nombre' => 'Grupo Empresarial del Litoral',
            'descripcion' => 'Organización dedicada a servicios administrativos, comerciales y financieros.',
            'logo' => null,
            'email' => 'rrhh@grupolitoral.com',
            'telefono' => '0345 400-2000',
            'sitio_web' => 'https://www.grupolitoral.com',
            'direccion' => 'Urquiza 850',
            'localidad' => 'Concordia',
            'provincia' => 'Entre Ríos',
            'activo' => true,
        ]);

        Organizacion::create([
            'nombre' => 'Industria del Litoral',
            'descripcion' => 'Empresa dedicada a la producción industrial y mantenimiento de instalaciones.',
            'logo' => null,
            'email' => 'empleos@industriadellitoral.com',
            'telefono' => '0345 400-3000',
            'sitio_web' => 'https://www.industriadellitoral.com',
            'direccion' => 'Parque Industrial',
            'localidad' => 'Concordia',
            'provincia' => 'Entre Ríos',
            'activo' => true,
        ]);

        Organizacion::create([
            'nombre' => 'Servicios Profesionales ER',
            'descripcion' => 'Empresa de servicios profesionales, capacitación y consultoría.',
            'logo' => null,
            'email' => 'info@servicioser.com',
            'telefono' => '0345 400-4000',
            'sitio_web' => 'https://www.servicioser.com',
            'direccion' => 'San Martín 620',
            'localidad' => 'Concordia',
            'provincia' => 'Entre Ríos',
            'activo' => true,
        ]);
    }
}
