<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perfiles', function (Blueprint $table) {

            $table->id();

            // Usuario propietario del perfil
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Datos personales
            $table->string('nombre', 100)->nullable();
            $table->string('apellido', 100)->nullable();
            $table->string('dni', 20)->nullable()->unique();
            $table->string('telefono', 50)->nullable();
            $table->date('fecha_nacimiento')->nullable();

            // Ubicación
            $table->string('direccion', 255)->nullable();
            $table->foreignId('localidad_id')
                ->nullable()
                ->constrained('localidades')
                ->nullOnDelete();

            // Información profesional
            $table->text('biografia')->nullable();
            $table->string('foto')->nullable();
            $table->string('cv')->nullable();

            // Redes / sitios profesionales
            $table->string('linkedin', 255)->nullable();
            $table->string('sitio_web', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
