<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();

            // Información principal
            $table->string('titulo', 150);
            $table->string('slug')->index();
            $table->text('descripcion');

            $table->foreignId('empresa_id')
                ->constrained('empresas')
                ->cascadeOnDelete();

            // Tipo de oferta: trabajo o pasantía
            $table->foreignId('tipo_oferta_id')
                ->constrained('tipos_oferta')
                ->restrictOnDelete();

            // Categoría
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->restrictOnDelete();

            $table->foreignId('subcategoria_id')
                ->constrained('subcategorias')
                ->restrictOnDelete();

            // Ubicación
            $table->string('ubicacion', 150);

            // Modalidad
            $table->foreignId('modalidad_id')
                ->constrained('modalidades')
                ->restrictOnDelete();

            // Tipo de contratación
            $table->foreignId('tipo_contratacion_id')
                ->constrained('tipos_contratacion')
                ->restrictOnDelete();

            // Fechas
            $table->date('fecha_publicacion');
            $table->date('fecha_cierre');

            // Estado
            $table->boolean('activo')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
