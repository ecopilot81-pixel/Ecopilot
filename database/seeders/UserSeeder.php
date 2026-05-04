<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'rol_id' => 1, 
            'zona_id' => 3, 
            'name' => 'JUANDAVID',
            'email' => 'admin@ecopilot.com',
            'password' => Hash::make('admin123'), 
            'puntos_totales' => 1000,
            'estado_onboarding' => true,
            'estado_usuario' => 'activo',
        ]);

        User::create([
            'rol_id' => 3, 
            'zona_id' => 1, 
            'name' => 'Reciclador Estrella',
            'email' => 'usuario@test.com',
            'password' => Hash::make('user123'),
            'puntos_totales' => 50,
            'estado_onboarding' => false, 
            'estado_usuario' => 'activo',
        ]);

        User::create([
            'rol_id' => 3,
            'zona_id' => 2, 
            'name' => 'Elena Rodriguez',
            'email' => 'elena@test.com',
            'password' => Hash::make('user123'),
            'puntos_totales' => 750, 
            'estado_onboarding' => true,
            'estado_usuario' => 'activo',
        ]);

        
        User::create([
            'rol_id' => 3,
            'zona_id' => 1,
            'name' => 'Carlos Mendez',
            'email' => 'carlos@test.com',
            'password' => Hash::make('user123'),
            'puntos_totales' => 10, // Iniciando
            'estado_onboarding' => true,
            'estado_usuario' => 'activo',
        ]);
    }
}
