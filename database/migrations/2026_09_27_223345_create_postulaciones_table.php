<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postulaciones', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('trabajo_id')
                ->constrained('trabajos')
                ->cascadeOnDelete();

            $table->enum('estado', [
                'pendiente',
                'en_revision',
                'seleccionado',
                'rechazado',
                'retirado',
            ])->default('pendiente');

            $table->timestamp('fecha_postulacion')
                ->useCurrent();

            $table->text('observaciones')
                ->nullable();

            $table->timestamps();

            // Un usuario no puede postularse dos veces
            // a la misma oferta.
            $table->unique([
                'user_id',
                'trabajo_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};