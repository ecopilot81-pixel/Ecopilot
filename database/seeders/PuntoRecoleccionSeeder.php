<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PuntoRecolecione;

class PuntoRecoleccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $puntos = [
            [
                'administrador_id' => 1, 
                'zona_id' => 3, 
                'nombre_lugar' => 'EcoPunto Parque Caldas',
                'direccion' => 'Carrera 6 # 3-12',
                'latitud' => 2.44190000,
                'longitud' => -76.60630000,
                'telefono' => '3101234567',
                'horario_atencion' => 'Lunes a Viernes 08:00 AM - 05:00 PM',
                'estado_punto' => 'activo',
            ],
            [
                'administrador_id' => 1,
                'zona_id' => 1, 
                'nombre_lugar' => 'Centro de Acopio Campanario',
                'direccion' => 'Avenida Papayal # 15N-20',
                'latitud' => 2.45820000,
                'longitud' => -76.59780000,
                'telefono' => '3209876543',
                'horario_atencion' => 'Sábados 09:00 AM - 02:00 PM',
                'estado_punto' => 'activo',
            ],
        ];

        foreach ($puntos as $punto) {
            PuntoRecolecione::create($punto);
        }
    }
}
