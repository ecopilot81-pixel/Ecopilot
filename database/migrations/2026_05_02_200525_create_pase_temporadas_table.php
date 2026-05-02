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
        Schema::create('pase_temporadas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tienda_item_id')->constrained()->onDelete('cascade');
            
            $table->integer('nivel_requerido');
            $table->enum('tipo_pase', ['gratis', 'premium'])->default('gratis'); 
            $table->integer('cantidad_recompensa')->default(1);
            $table->string('temporada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pase_temporadas');
    }
};
