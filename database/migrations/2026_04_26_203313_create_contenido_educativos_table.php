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
        Schema::create('contenido_educativos', function (Blueprint $table) {
            $table->id('Id_contenido');

            $table->foreignId('id_usuario')
            ->nullable() 
            ->constrained('users', 'Id_usuario')
            ->onDelete('set null');
            
            $table->foreignId('id_categoria')->constrained('categoria_globals', 'Id_categoria');

            $table->string('titulo', 255);
            $table->string('tipo_publico');
            $table->string('tipo_formato');
            $table->text('descripcion');
            $table->string('url_recurso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenido_educativos');
    }
};
