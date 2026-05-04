<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadoArbole;
use Carbon\Carbon;

class EstadoArbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            [
                'user_id' => 1, 
                'nivel_crecimiento' => 5, 
                'moneda_virtual_saldo' => 1500, 
                'ultima_interaccion' => Carbon::now(),
            ],
            [
                'user_id' => 2, 
                'nivel_crecimiento' => 1, 
                'moneda_virtual_saldo' => 50,
                'ultima_interaccion' => Carbon::now()->subDays(2), 
            ],
            [
                'user_id' => 3, 
                'nivel_crecimiento' => 3, 
                'moneda_virtual_saldo' => 800, 
                'ultima_interaccion' => Carbon::now(),
            ],
            [
                'user_id' => 4, 
                'nivel_crecimiento' => 2, 
                'moneda_virtual_saldo' => 300,
                'ultima_interaccion' => Carbon::now()->subDays(2), 
            ],
        ];

        foreach ($estados as $e) {
            EstadoArbole::create($e);
        }
    }
}
