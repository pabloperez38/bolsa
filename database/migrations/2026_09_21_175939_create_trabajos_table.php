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

            $table->foreignId('organizacion_id')
                ->constrained('organizaciones')
                ->cascadeOnDelete();

            $table->text('descripcion')->nullable();

            // ==========================================
            // CATEGORÍA
            // ==========================================

            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained('categorias')
                ->nullOnDelete();

            $table->foreignId('subcategoria_id')
                ->nullable()
                ->constrained('subcategorias')
                ->nullOnDelete();

            // ==========================================
            // UBICACIÓN
            // ==========================================

            $table->string('ubicacion', 150)->nullable();

            // Ejemplo:
            // Presencial
            // Remoto
            // Híbrido

            $table->string('modalidad', 30)->default('Presencial');

            // ==========================================
            // TIPO DE CONTRATACIÓN
            // ==========================================

            // Full-time
            // Part-time
            // Freelance
            // Pasantía
            // Temporal

            $table->string('tipo_contratacion', 50)->nullable();

            // ==========================================
            // SALARIO
            // ==========================================

            $table->decimal('salario_minimo', 12, 2)->nullable();

            $table->decimal('salario_maximo', 12, 2)->nullable();

            $table->string('moneda', 10)->default('ARS');

            // ==========================================
            // FECHAS
            // ==========================================

            $table->date('fecha_publicacion')->nullable();

            $table->date('fecha_cierre')->nullable();

            // ==========================================
            // ESTADO
            // ==========================================

            $table->boolean('destacado')->default(false);

            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trabajos');
    }
};
