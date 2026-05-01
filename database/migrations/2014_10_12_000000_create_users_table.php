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
        Schema::create('users', function (Blueprint $table) {
            $table->id('Id_usuario');

            $table->foreignId('id_rol')->constrained('roles', 'Id_rol')->onDelete('restrict');
            $table->foreignId('id_zona')->constrained('zonas', 'Id_zona')->onDelete('restrict');

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('puntos_totales')->default(0);
            $table->boolean('estado_onboarding')->default(false);
            $table->string('estado_usuario')->default('activo');
            $table->date('fecha_registro');
            $table->date('ultimo_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
