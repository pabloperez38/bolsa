<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $subcategorias = [

            // =====================================================
            // 1. TECNOLOGÍA E INFORMÁTICA
            // =====================================================
            'Tecnología e Informática' => [
                'Desarrollo Web',
                'Desarrollo de Software',
                'Soporte Técnico',
                'Redes y Telecomunicaciones',
                'Bases de Datos',
                'Ciberseguridad',
                'Análisis de Datos',
            ],

            // =====================================================
            // 2. ADMINISTRACIÓN Y FINANZAS
            // =====================================================
            'Administración y Finanzas' => [
                'Administración',
                'Contabilidad',
                'Finanzas',
                'Tesorería',
                'Recursos Humanos',
                'Compras',
                'Auditoría',
            ],

            // =====================================================
            // 3. MARKETING Y COMUNICACIÓN
            // =====================================================
            'Marketing y Comunicación' => [
                'Marketing Digital',
                'Comunicación Institucional',
                'Publicidad',
                'Redes Sociales',
                'Community Management',
                'Relaciones Públicas',
                'Creación de Contenidos',
            ],

            // =====================================================
            // 4. DISEÑO Y CREATIVIDAD
            // =====================================================
            'Diseño y Creatividad' => [
                'Diseño Gráfico',
                'Diseño UX/UI',
                'Diseño Web',
                'Ilustración',
                'Fotografía',
                'Edición de Video',
                'Animación',
            ],

            // =====================================================
            // 5. INGENIERÍA
            // =====================================================
            'Ingeniería' => [
                'Ingeniería Industrial',
                'Ingeniería Mecánica',
                'Ingeniería Eléctrica',
                'Ingeniería Electrónica',
                'Ingeniería Civil',
                'Automatización y Control',
                'Gestión de Proyectos',
            ],

            // =====================================================
            // 6. SALUD
            // =====================================================
            'Salud' => [
                'Enfermería',
                'Medicina',
                'Odontología',
                'Kinesiología',
                'Laboratorio',
                'Administración de Salud',
                'Instrumentación Quirúrgica',
            ],

            // =====================================================
            // 7. EDUCACIÓN
            // =====================================================
            'Educación' => [
                'Docencia',
                'Educación Inicial',
                'Educación Primaria',
                'Educación Secundaria',
                'Educación Superior',
                'Capacitación',
                'Educación a Distancia',
            ],

            // =====================================================
            // 8. COMERCIO Y VENTAS
            // =====================================================
            'Comercio y Ventas' => [
                'Ventas',
                'Atención al Cliente',
                'Desarrollo Comercial',
                'Ejecutivos de Cuenta',
                'Comercio Minorista',
                'Comercio Mayorista',
                'Negociación',
            ],

            // =====================================================
            // 9. INDUSTRIA Y PRODUCCIÓN
            // =====================================================
            'Industria y Producción' => [
                'Producción',
                'Mantenimiento Industrial',
                'Control de Calidad',
                'Seguridad e Higiene',
                'Operaciones',
                'Planificación de Producción',
                'Gestión de Procesos',
            ],

            // =====================================================
            // 10. LOGÍSTICA Y TRANSPORTE
            // =====================================================
            'Logística y Transporte' => [
                'Logística',
                'Transporte',
                'Distribución',
                'Depósito y Almacén',
                'Gestión de Inventarios',
                'Compras y Abastecimiento',
                'Planificación Logística',
            ],
        ];

        // =========================================================
        // CREAR SUBCATEGORÍAS
        // =========================================================

        foreach ($subcategorias as $nombreCategoria => $nombresSubcategorias) {

            // Buscar la categoría por su nombre
            $categoria = Categoria::where('nombre', $nombreCategoria)->first();

            // Si la categoría no existe, continuar con la siguiente
            if (!$categoria) {
                continue;
            }

            // Crear las subcategorías
            foreach ($nombresSubcategorias as $nombreSubcategoria) {

                Subcategoria::updateOrCreate(
                    [
                        'categoria_id' => $categoria->id,
                        'nombre' => $nombreSubcategoria,
                    ],
                    [
                        'descripcion' => null,
                        'activo' => true,
                    ]
                );
            }
        }
    }
}
