<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaTienda;

class CategoriaTiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Cosméticos de Avatar',
                'descripcion' => 'Ropa y accesorios para personalizar tu personaje en el juego.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Mejoras de Árbol',
                'descripcion' => 'Fertilizantes y skins especiales para tu árbol virtual.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Potenciadores (Buffs)',
                'descripcion' => 'Multiplicadores de puntos de reciclaje por tiempo limitado.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Pases Especiales',
                'descripcion' => 'Acceso a misiones exclusivas y recompensas premium.',
                'estado' => 1,
            ],
        ];

        foreach ($categorias as $categoria) {
            CategoriaTienda::create($categoria);
        }
    }
}
