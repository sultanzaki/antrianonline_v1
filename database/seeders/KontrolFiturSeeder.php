<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontrolFiturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kontrolFitur = [
            [
                'nama_fitur' => 'valas',
                'status' => 'aktif',
            ],
            [
                'nama_fitur' => 'counter_rates',
                'status' => 'aktif',
            ],
            [
                'nama_fitur' => 'lps',
                'status' => 'aktif',
            ],
            [
                'nama_fitur' => 'iklan',
                'status' => 'aktif',
            ],
        ];

        foreach ($kontrolFitur as $fitur) {
            \App\Models\KontrolFitur::create($fitur);
        }
    }
}
