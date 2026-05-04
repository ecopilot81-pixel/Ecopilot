<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriaGlobalSeeder::class,
            RoleSeeder::class,
            ZonaSeeder::class,
            TipoMaterialSeeder::class,
            CategoriaTiendaSeeder::class,
            UserSeeder::class,
            ContenidoEducativoSeeder::class,
            NoticiaSeeder::class,
            PerfileSeeder::class,
            RankingSemanalSeeder::class,
            FeedbackSeeder::class,
            ProgresoPaseSeeder::class,
            EstadoArbolSeeder::class,
            HistorialChatSeeder::class,
            TiendaItemSeeder::class,
            PaseTemporadaSeeder::class,
            PuntoRecoleccionSeeder::class,
            RecompensaReclamadaSeeder::class,
            RegistroReciclajeSeeder::class,
            InventarioUsuarioSeeder::class,
            MaterialPorPuntoSeeder::class,
        ]);
    }
}
