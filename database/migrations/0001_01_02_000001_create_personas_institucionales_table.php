<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personas_institucionales', function (Blueprint $table) {

            $table->id();

            // Identificación institucional
            $table->string('dni', 20)->unique();
            $table->string('legajo', 30)->unique();

            // Datos personales
            $table->string('nombre');
            $table->string('apellido');

            // Tipo de persona dentro de la institución
            $table->enum('tipo', [
                'estudiante',
                'graduado',
                'docente',
            ]);

            // Datos académicos / institucionales
            $table->string('carrera')->nullable();

            // Cantidad de materias aprobadas
            $table->unsignedInteger('materias_aprobadas')->default(0);

            // Estado del registro institucional
            $table->boolean('activo')->default(true);
            // Eliminación lógica
            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas_institucionales');
    }
};
