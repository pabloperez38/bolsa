<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizaciones', function (Blueprint $table) {

            $table->id();

            $table->string('nombre', 150);

            $table->string('descripcion')->nullable();

            $table->string('logo')->nullable();

            $table->string('email', 150)->nullable();

            $table->string('telefono', 50)->nullable();

            $table->string('sitio_web', 255)->nullable();

            $table->string('direccion', 255)->nullable();

            $table->string('localidad', 100)->nullable();

            $table->string('provincia', 100)->nullable();

            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizaciones');
    }
};
