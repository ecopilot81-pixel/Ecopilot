<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoMateriale;

class TipoMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materiales = [
            [
                'nombre' => 'Botellas PET',
                'valor_puntos' => 10,
                'unidad_medidas' => 'Unidad',
                'instrucciones' => 'Lavar, secar y aplastar antes de entregar.',
                'icono' => 'fas fa-bottle-water',
            ],
            [
                'nombre' => 'Cartón Corrugado',
                'valor_puntos' => 50,
                'unidad_medidas' => 'Kilogramo',
                'instrucciones' => 'Quitar cintas adhesivas y entregar seco.',
                'icono' => 'fas fa-box',
            ],
            [
                'nombre' => 'Latas de Aluminio',
                'valor_puntos' => 15,
                'unidad_medidas' => 'Unidad',
                'instrucciones' => 'Enjuagar y compactar si es posible.',
                'icono' => 'fas fa-whiskey-glass',
            ],
            [
                'nombre' => 'Papel de Oficina',
                'valor_puntos' => 30,
                'unidad_medidas' => 'Kilogramo',
                'instrucciones' => 'Sin ganchos metálicos ni clips.',
                'icono' => 'fas fa-file-lines',
            ],
        ];

        foreach ($materiales as $material) {
            TipoMateriale::create($material);
        }
    }
}
