<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersSeeder extends Seeder
{
    public function run(): void
    {
        try {
            DB::table('suppliers')->insert([
                ['name' => 'WEBMOTORS SA', 'cnpj' => '03347828000109'],
                ['name' => 'REVENDA MAIS', 'cnpj' => '03995142000124'],
            ]);
        } catch (\Throwable $e) {
        }
    }
}
