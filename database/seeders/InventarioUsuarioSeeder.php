<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InventarioUsuario;

class InventarioUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventarios = [
            [
                'user_id' => 1,
                'tienda_item_id' => 1, 
                'cantidad' => 1,
            ],
            [
                'user_id' => 2,
                'tienda_item_id' => 2,
                'cantidad' => 3, 
            ],
            [
                'user_id' => 3,
                'tienda_item_id' => 3,
                'cantidad' => 1,
            ],
            [
                'user_id' => 4,
                'tienda_item_id' => 1,
                'cantidad' => 3,
            ],
        ];

        foreach ($inventarios as $inv) {
            InventarioUsuario::create($inv);
        }
    }
}
