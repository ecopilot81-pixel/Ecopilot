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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id('Id_noticia');

            $table->foreignId('id_categoria')->nullable()->constrained('categoria_globals', 'Id_categoria');
            $table->foreignId('id_usuario')->nullable()->constrained('users', 'Id_usuario')->onDelete('set null');

            $table->string('titulo', 255);
            $table->text('resumen');
            $table->text('contenido');
            $table->string('imagen_destacada')->nullable();
            $table->string('fuente')->nullable();
            $table->string('url_fuente')->nullable();
            $table->date('fecha_publicacion');
            $table->string('estado_noticia')->default('publicada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
