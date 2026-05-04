<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaGlobal;

class CategoriaGlobalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
        ['nombre' => 'Reciclaje Plásticos', 'icono' => 'fas fa-bottle-water'],
        ['nombre' => 'Educación Ambiental', 'icono' => 'fas fa-book-leaf'],
        ['nombre' => 'Eventos Comunitarios', 'icono' => 'fas fa-users-gear'],
        ['nombre' => 'Puntos Limpios', 'icono' => 'fas fa-location-dot'],
        ['nombre' => 'Noticias Verdes', 'icono' => 'fas fa-newspaper'],
    ];

    foreach ($categorias as $categoria) {
        CategoriaGlobal::create($categoria);
    }
    }
}