<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HistorialChat;

class HistorialChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chats = [
            [
                'user_id' => 1, 
                'pregunta_usuario' => '¿Cómo puedo subir de nivel mi árbol más rápido?',
                'respuesta_bot' => '¡Hola! Para que tu árbol crezca, debes registrar entregas de material reciclable en los puntos autorizados. Los plásticos PET dan el doble de experiencia esta semana.',
            ],
            [
                'user_id' => 2,
                'pregunta_usuario' => '¿Dónde hay un punto de reciclaje cerca del Parque Caldas?',
                'respuesta_bot' => 'He encontrado un punto de acopio en la Calle 4 con Carrera 5. ¡Está a solo dos cuadras de tu ubicación actual!',
            ],
            [
                'user_id' => 3, 
                'pregunta_usuario' => '¿Qué hago con el aceite de cocina usado?',
                'respuesta_bot' => 'No lo viertas por el desagüe. Debes envasarlo en una botella plástica y llevarlo al centro de acopio especializado en residuos químicos.',
            ],
            [
                'user_id' => 4, 
                'pregunta_usuario' => '¿Dónde puedo llevar mis residuos electronicos?',
                'respuesta_bot' => 'Puedes llevar tus residuos electronicos al punto de acopio ubicado en el Centro Comercial la Estacion, en la avenida 6 con calle 3.',
            ],
        ];

        foreach ($chats as $chat) {
            HistorialChat::create($chat);
        }
    }
}
