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

            // ==========================================
            // INFORMACIÓN PRINCIPAL
            // ==========================================

            $table->string('titulo', 150);

            $table->text('descripcion');

            $table->foreignId('organizacion_id')
                ->constrained('organizaciones')
                ->cascadeOnDelete();

            // ==========================================
            // TIPO DE OFERTA
            // ==========================================
            // Trabajo / Pasantía

            $table->foreignId('tipo_oferta_id')
                ->constrained('tipos_oferta')
                ->restrictOnDelete();

            // ==========================================
            // CATEGORÍA
            // ==========================================

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->restrictOnDelete();

            $table->foreignId('subcategoria_id')
                ->constrained('subcategorias')
                ->restrictOnDelete();

            // ==========================================
            // UBICACIÓN
            // ==========================================

            $table->string('ubicacion', 150);

            // ==========================================
            // MODALIDAD
            // ==========================================
            // Presencial / Remoto / Híbrido

            $table->foreignId('modalidad_id')
                ->constrained('modalidades')
                ->restrictOnDelete();

            // ==========================================
            // TIPO DE CONTRATACIÓN
            // ==========================================
            // Full-time / Part-time / Freelance /
            // Temporal / Por proyecto

            $table->foreignId('tipo_contratacion_id')
                ->constrained('tipos_contratacion')
                ->restrictOnDelete();

            // ==========================================
            // FECHAS
            // ==========================================

            $table->date('fecha_publicacion');

            $table->date('fecha_cierre');

            // ==========================================
            // ESTADO
            // ==========================================

            $table->boolean('activo')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
