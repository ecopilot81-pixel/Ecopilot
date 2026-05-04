<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecompensaReclamada;
use Carbon\Carbon;
class RecompensaReclamadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reclamaciones = [
            [
                'user_id' => 1, 
                'pase_temporada_id' => 1, 
                'fecha_reclamo' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 2, 
                'pase_temporada_id' => 2, 
                'fecha_reclamo' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 3, 
                'pase_temporada_id' => 2, 
                'fecha_reclamo' => Carbon::now()->subDay(),
            ],
            [
                'user_id' => 4, 
                'pase_temporada_id' => 1, 
                'fecha_reclamo' => Carbon::now()->subDay(),
            ],
        ];

        foreach ($reclamaciones as $r) {
            RecompensaReclamada::create($r);
        }
    }
}
