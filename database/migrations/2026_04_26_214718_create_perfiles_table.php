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
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id('Id_perfil');

            $table->foreignId('id_usuario')->nullable()->constrained('users', 'Id_usuario')->onDelete('set null');

            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('alias')->unique();
            $table->string('telefono');
            $table->string('ciudad');
            $table->string('foto_perfil');
            $table->string('biografia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
