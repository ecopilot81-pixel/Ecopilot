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
        Schema::create('tienda_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_tienda_id')->constrained()->onDelete('restrict');

            $table->string('nombre_item')->unique();
            $table->text('descripcion_beneficio')->nullable();
            $table->integer('costo_moneda_virtual')->default(0);
            $table->integer('stock')->default(0);
            $table->string('imagen_item')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tienda_items');
    }
};
