<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaseTemporada;

class PaseTemporadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recompensas = [
            [
                'tienda_item_id' => 2, 
                'nivel_requerido' => 2,
                'tipo_pase' => 'gratis',
                'cantidad_recompensa' => 1,
                'temporada' => 'Temporada 1: Brotes de Esperanza',
            ],
            [
                'tienda_item_id' => 3, 
                'nivel_requerido' => 5,
                'tipo_pase' => 'gratis',
                'cantidad_recompensa' => 2,
                'temporada' => 'Temporada 1: Brotes de Esperanza',
            ],
            [
                'tienda_item_id' => 1, 
                'nivel_requerido' => 10,
                'tipo_pase' => 'premium',
                'cantidad_recompensa' => 1,
                'temporada' => 'Temporada 1: Brotes de Esperanza',
            ],
            [
                'tienda_item_id' => 4, 
                'nivel_requerido' => 20,
                'tipo_pase' => 'premium',
                'cantidad_recompensa' => 1,
                'temporada' => 'Temporada 1: Brotes de Esperanza',
            ],
        ];

        foreach ($recompensas as $r) {
            PaseTemporada::create($r);
        }
    }
}
