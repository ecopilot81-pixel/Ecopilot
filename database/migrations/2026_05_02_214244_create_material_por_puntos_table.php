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
        Schema::create('material_por_puntos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tipo_material_id')->constrained()->onDelete('cascade');
            $table->foreignId('punto_recolecion_id')->constrained()->onDelete('cascade');

            $table->boolean('disponible')->default(true);
            $table->timestamp('fecha_vinculacion')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_por_puntos');
    }
};
