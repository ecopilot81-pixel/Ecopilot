<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('punto_recoleciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('administrador_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('zona_id')->constrained()->onDelete('restrict');

            $table->string('nombre_lugar');
            $table->string('direccion');
            $table->decimal('latitud', 10, 8);
            $table->decimal('longitud', 11, 8);
            $table->string('telefono')->nullable();
            $table->string('horario_atencion');
            $table->string('estado_punto')->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punto_recoleciones');
    }
};
