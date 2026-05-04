<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContenidoEducativo;

class ContenidoEducativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contenidos = [
            [
                'user_id' => 1, 
                'categoria_global_id' => 1, 
                'titulo' => 'Guía Maestra: El Plástico PET',
                'tipo_publico' => 'General',
                'tipo_formato' => 'Video', 
                'descripcion' => 'Aprende a identificar y preparar tus botellas para que sean 100% reciclables.',
                'url_recurso' => 'https://youtube.com/ejemplo-pet',
            ],
            [
                'user_id' => 1,
                'categoria_global_id' => 2, 
                'titulo' => '¿Qué es la Economía Circular?',
                'tipo_publico' => 'Niños',
                'tipo_formato' => 'Lectura',
                'descripcion' => 'Un cuento interactivo sobre cómo los desechos pueden convertirse en tesoros.',
                'url_recurso' => 'https://ecopilot.com/recursos/pdf-circular',
            ],
            [
                'user_id' => 1,
                'categoria_global_id' => 5, 
                'titulo' => 'Nuevos Puntos de Recolección en Popayán',
                'tipo_publico' => 'General',
                'tipo_formato' => 'Infografía',
                'descripcion' => 'Conoce las nuevas ubicaciones donde puedes llevar tu reciclaje este mes.',
                'url_recurso' => null,
            ],
        ];

        foreach ($contenidos as $contenido) {
            ContenidoEducativo::create($contenido);
        }
    }
}
