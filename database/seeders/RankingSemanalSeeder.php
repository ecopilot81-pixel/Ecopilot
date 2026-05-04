<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RankingSemanale;
use Carbon\Carbon;

class RankingSemanalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inicio = Carbon::now()->startOfWeek()->format('Y-m-d');
        $fin = Carbon::now()->endOfWeek()->format('Y-m-d');

        $rankings = [
            [
                'user_id' => 1, 
                'puntos_semanales' => 450,
                'posicion' => 2,
                'fecha_inicio' => $inicio,
                'fecha_fin' => $fin,
                'recompensa' => 'Insignia de Oro y 50 monedas extra',
            ],
            [
                'user_id' => 2, 
                'puntos_semanales' => 320,
                'posicion' => 3,
                'fecha_inicio' => $inicio,
                'fecha_fin' => $fin,
                'recompensa' => 'Insignia de Plata',
            ],
            [
                'user_id' => 3, 
                'puntos_semanales' => 490,
                'posicion' => 1,
                'fecha_inicio' => $inicio,
                'fecha_fin' => $fin,
                'recompensa' => 'Insignia de Oro y 50 monedas extra',
            ],
            [
                'user_id' => 4, 
                'puntos_semanales' => 210,
                'posicion' => 4,
                'fecha_inicio' => $inicio,
                'fecha_fin' => $fin,
                'recompensa' => 'Insignia de Bronce',
            ],
        ];

        foreach ($rankings as $ranking) {
            RankingSemanale::create($ranking);
        }
    }
}
