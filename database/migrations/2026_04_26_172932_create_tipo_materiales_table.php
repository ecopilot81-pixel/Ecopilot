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
        Schema::create('tipo_materiales', function (Blueprint $table) {
            $table->id('Id material');
            $table->string('nombre_material', 50)->unique();
            $table->integer('valor_puntos')->default(0); 
            $table->string('unidad_medidas', 20)->default('unidades');
            $table->text('instruciones');
            $table->string('icono')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_materiales');
    }
};
