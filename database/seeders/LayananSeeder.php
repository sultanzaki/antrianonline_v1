<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = [
            [
                'nama_pelayanan' => 'Teller',
                'deskripsi' => 'Pelayanan Teller',
            ],
            [
                'nama_pelayanan' => 'Customer Service',
                'deskripsi' => 'Pelayanan Customer Service',
            ],
        ];

        foreach ($layanan as $layanan) {
            \App\Models\Layanan::create($layanan);
        }
    }
}
