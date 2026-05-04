<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perfile;

class PerfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perfiles = [
            [
                'user_id' => 1, 
                'nombre' => 'Juan',
                'apellido' => 'David',
                'alias' => 'ECOPILOT_ADD',
                'telefono' => '3001234567',
                'ciudad' => 'Popayán',
                'foto_perfil' => 'admin_avatar.png',
                'biografia' => 'Desarrollador principal de EcoPilot. Comprometido con la tecnología y el planeta.',
            ],
            [
                'user_id' => 2, 
                'nombre' => 'Carlos',
                'apellido' => 'Pérez',
                'alias' => 'EcoGuerrero26',
                'telefono' => null,
                'ciudad' => 'Popayán',
                'foto_perfil' => null,
                'biografia' => 'Me encanta reciclar para mejorar mi árbol virtual.',
            ],
            [
                'user_id' => 3, 
                'nombre' => 'Elena',
                'apellido' => 'Rodriguez',
                'alias' => 'EcoSuper',
                'telefono' => '3002345678',
                'ciudad' => 'Popayán',
                'foto_perfil' => 'elena_avatar.png',
                'biografia' => 'Amante de la naturaleza y el reciclaje de plástico.',
            ],
            [
                'user_id' => 4, 
                'nombre' => 'Camilo',
                'apellido' => 'Pérez',
                'alias' => 'protectorVerde',
                'telefono' => null,
                'ciudad' => 'Popayán',
                'foto_perfil' => null,
                'biografia' => 'Empezando mi camino eco-amigable.',
            ],
        ];

        foreach ($perfiles as $perfil) {
            Perfile::create($perfil);
        }
    }
}
