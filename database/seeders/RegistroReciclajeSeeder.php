<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RegistroReciclaje;

class RegistroReciclajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = [
            [
                'user_id' => 1, 
                'tipo_material_id' => 1, 
                'punto_recoleccion_id' => 1, 
                'cantidad' => 2.5,
                'puntos_ganados' => 250,
                'estado' => 'completado',
            ],
            [
                'user_id' => 2,
                'tipo_material_id' => 2,
                'punto_recoleccion_id' => 2, 
                'cantidad' => 5.0,
                'puntos_ganados' => 400,
                'estado' => 'completado',
            ],
            [
                'user_id' => 3, 
                'tipo_material_id' => 3,
                'punto_recoleccion_id' => 2,
                'cantidad' => 1.8,
                'puntos_ganados' => 150,
                'estado' => 'pendiente', 
            ],
            [
                'user_id' => 4, 
                'tipo_material_id' => 2,
                'punto_recoleccion_id' => 1,
                'cantidad' => 5.2,
                'puntos_ganados' => 400,
                'estado' => 'pendiente', 
            ],
        ];

        foreach ($registros as $registro) {
            RegistroReciclaje::create($registro);
        }
    }
}
