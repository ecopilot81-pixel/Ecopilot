<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Noticia;

class NoticiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $noticias = [
            [
                'categoria_global_id' => 5, 
                'user_id' => 1, 
                'titulo' => 'Gran Jornada de Reciclaje en el Parque Caldas',
                'resumen' => 'Este sábado nos unimos para recolectar más de 2 toneladas de plástico.',
                'contenido' => 'La comunidad de Popayán demostró su compromiso con el medio ambiente en una jornada masiva que duró 8 horas...',
                'imagen_destacada' => 'jornada_parque.jpg',
                'fuente' => 'EcoPilot Local',
                'url_fuente' => 'https://ecopilot.com/noticias/jornada-caldas',
                'estado_noticia' => 'publicada',
            ],
            [
                'categoria_global_id' => 2, 
                'titulo' => 'Nuevo Récord de Usuarios en EcoPilot',
                'resumen' => 'Hemos superado los 1,000 usuarios activos este mes.',
                'contenido' => 'Gracias al nuevo sistema de gamificación y la tienda del juego, más personas se han sumado a reciclar diariamente...',
                'imagen_destacada' => 'record_usuarios.png',
                'fuente' => 'Equipo de Desarrollo',
                'url_fuente' => null,
                'estado_noticia' => 'publicada',
            ],
        ];

        foreach ($noticias as $noticia) {
            Noticia::create($noticia);
        }
    }
}
