<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comentarios = [
            [
                'user_id' => 1, 
                'puntuacion' => 5,
                'comentario' => '¡Excelente plataforma! La gamificación con el árbol es muy motivadora.',
                'version_app' => '1.0.0',
                'estado_visible' => true,
            ],
            [
                'user_id' => 2, 
                'puntuacion' => 4,
                'comentario' => 'Me gusta mucho la idea, pero me gustaría ver más centros de acopio en el mapa.',
                'version_app' => '1.0.0',
                'estado_visible' => true,
            ],
            [
                'user_id' => 3,
                'puntuacion' => 3,
                'comentario' => 'La aplicación es buena, pero tuve algunos problemas técnicos al subir mis registros de reciclaje.',
                'version_app' => '1.0.0',
                'estado_visible' => false, 
            ],
            [
                'user_id' => 4,
                'puntuacion' => 2,
                'comentario' => 'Tuve un pequeño error al intentar redimir mis puntos en la tienda.',
                'version_app' => '0.9.8-beta',
                'estado_visible' => false, 
            ],
        ];

        foreach ($comentarios as $f) {
            Feedback::create($f);
        }
    }
}
