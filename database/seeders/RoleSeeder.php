<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Control total del sistema, gestión de usuarios y reportes.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Recolector',
                'descripcion' => 'Encargado de validar los materiales entregados en los puntos.',
                'estado' => 1,
            ],
            [
                'nombre' => 'Usuario',
                'descripcion' => 'Ciudadano que recicla, gana puntos y canjea premios.',
                'estado' => 1,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
