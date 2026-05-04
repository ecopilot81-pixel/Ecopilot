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
        Schema::create('registro_reciclajes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_material_id')->constrained('tipo_materiales')->onDelete('restrict');
            $table->foreignId('punto_recoleccion_id')->constrained('punto_recoleciones')->onDelete('restrict');

            $table->decimal('cantidad', 8, 2);
            $table->integer('puntos_ganados');
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_reciclajes');
    }
};
