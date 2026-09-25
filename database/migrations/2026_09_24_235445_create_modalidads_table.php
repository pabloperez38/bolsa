<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modalidades', function (Blueprint $table) {

            $table->id();

            // Nombre de la modalidad
            // Presencial / Remoto / Híbrido
            $table->string('nombre', 50)->unique();

            // Permite activar/desactivar la modalidad
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modalidades');
    }
};
