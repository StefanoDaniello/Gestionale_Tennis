<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrenotazioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prenotazioni')->insert([
            [
                'Data' => now()->format('Y-m-d'), // Imposta la data corrente
                'Start_Time' => now()->addHours(1)->format('H:i:s'), // Estrai solo l'orario
                'End_Time' => now()->addHours(2)->format('H:i:s'),
                'campo_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Data' => now()->format('Y-m-d'),
                'Start_Time' => now()->addHours(3)->format('H:i:s'),
                'End_Time' => now()->addHours(4)->format('H:i:s'),
                'campo_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Data' => now()->format('Y-m-d'),
                'Start_Time' => now()->addHours(5)->format('H:i:s'),
                'End_Time' => now()->addHours(6)->format('H:i:s'),
                'campo_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Data' => now()->format('Y-m-d'),
                'Start_Time' => now()->addHours(7)->format('H:i:s'),
                'End_Time' => now()->addHours(8)->format('H:i:s'),
                'campo_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Data' => now()->format('Y-m-d'),
                'Start_Time' => now()->addHours(9)->format('H:i:s'),
                'End_Time' => now()->addHours(10)->format('H:i:s'),
                'campo_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

