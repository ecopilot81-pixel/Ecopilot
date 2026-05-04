<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TiendaItem;


class TiendaItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'categoria_tienda_id' => 1, 
                'nombre_item' => 'Sombrero de Explorador Reciclado',
                'descripcion_beneficio' => 'Un accesorio único hecho de fibras naturales para tu avatar.',
                'costo_moneda_virtual' => 200,
                'stock' => 50,
                'imagen_item' => 'items/sombrero_explorador.png',
            ],
            [
                'categoria_tienda_id' => 2, 
                'nombre_item' => 'Fertilizante Orgánico Pro',
                'descripcion_beneficio' => 'Aumenta la velocidad de crecimiento de tu árbol un 20% durante 24 horas.',
                'costo_moneda_virtual' => 500,
                'stock' => 100,
                'imagen_item' => 'items/fertilizante_pro.png',
            ],
            [
                'categoria_tienda_id' => 3, 
                'nombre_item' => 'Multiplicador x2 de Puntos',
                'descripcion_beneficio' => 'Duplica los puntos ganados en tu próxima entrega de reciclaje.',
                'costo_moneda_virtual' => 350,
                'stock' => 30,
                'imagen_item' => 'items/buff_puntos.png',
            ],
            [
                'categoria_tienda_id' => 4, 
                'nombre_item' => 'Ticket de Evento Comunitario',
                'descripcion_beneficio' => 'Acceso exclusivo al torneo de reciclaje masivo del mes.',
                'costo_moneda_virtual' => 1000,
                'stock' => 10,
                'imagen_item' => 'items/ticket_evento.png',
            ],
        ];

        foreach ($items as $item) {
            TiendaItem::create($item);
        }
    }
}
