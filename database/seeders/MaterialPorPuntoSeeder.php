<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaterialPorPunto;

class MaterialPorPuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vinculaciones = [
            [
                'tipo_material_id' => 1, 
                'punto_recolecion_id' => 1, 
                'disponible' => true,
            ],
            [
                'tipo_material_id' => 2, 
                'punto_recolecion_id' => 1, 
                'disponible' => true,
            ],
            [
                'tipo_material_id' => 1, 
                'punto_recolecion_id' => 2, 
                'disponible' => true,
            ],
            [
                'tipo_material_id' => 3, 
                'punto_recolecion_id' => 2, 
                'disponible' => false, 
            ],
        ];

        foreach ($vinculaciones as $v) {
            MaterialPorPunto::create($v);
        }
    }
}
