<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('campi')->insert([
            ['Name' => 'Campo-1','created_at' => now(), 'updated_at' => now()],
            ['Name' => 'Campo-2','created_at' => now(), 'updated_at' => now()],
            ['Name' => 'Campo-3','created_at' => now(), 'updated_at' => now()],
            ['Name' => 'Campo-4','created_at' => now(), 'updated_at' => now()],
            ['Name' => 'Campo-5','created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
