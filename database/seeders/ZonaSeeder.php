<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zona;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zonas = [
            [
                'nombre' => 'Sector Norte',
                'codigo_postal' => '190001',
                'estado' => 1, 
            ],
            [
                'nombre' => 'Sector Sur',
                'codigo_postal' => '190002',
                'estado' => 1,
            ],
            [
                'nombre' => 'Centro Histórico',
                'codigo_postal' => '190003',
                'estado' => 1,
            ],
            [
                'nombre' => 'Zona Rural Oriente',
                'codigo_postal' => '190004',
                'estado' => 1,
            ],
        ];

        foreach ($zonas as $zona) {
            Zona::create($zona);
        }
    }
}
