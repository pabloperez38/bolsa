<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración.
     */
    public function up(): void
    {
        Schema::create('subcategorias', function (Blueprint $table) {

            $table->id();
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->cascadeOnDelete();
            $table->string('nombre', 150);
            $table->string('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->softDeletes();
            $table->timestamps();
            // Evita repetir una subcategoría dentro de la misma categoría
            $table->unique(['categoria_id', 'nombre']);
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategorias');
    }
};
