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
        Schema::create('tipos_oferta', function (Blueprint $table) {

            $table->id();

            // Nombre del tipo de oferta:
            // Trabajo / Pasantía
            $table->string('nombre', 100)->unique();

            // Permite activar/desactivar el tipo
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_oferta');
    }
};
