<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgresoPase;
class ProgresoPaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $progresos = [
            [
                'user_id' => 1, 
                'experiencia' => 2500,
                'nivel_actual' => 15,
                'es_premium' => true, 
            ],
            [
                'user_id' => 2, 
                'experiencia' => 150,
                'nivel_actual' => 2,
                'es_premium' => false,
            ],
            [
                'user_id' => 3, 
                'experiencia' => 1200,
                'nivel_actual' => 10,
                'es_premium' => true, 
            ],
            [
                'user_id' => 4, 
                'experiencia' => 100,
                'nivel_actual' => 1,
                'es_premium' => false,
            ],
        ];

        foreach ($progresos as $p) {
            ProgresoPase::create($p);
        }
    }
}
