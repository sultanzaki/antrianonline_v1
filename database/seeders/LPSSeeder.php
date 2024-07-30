<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LPSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lps = [
            [
                'nama_rate' => 'Bank Umum (IDR)',
                'rate' => 0.0001,
            ],
            [
                'nama_rate' => 'BPR',
                'rate' => 0.0001,
            ],
            [
                'nama_rate' => 'Bank Umum (Valas)',
                'rate' => 0.0001,
            ],
        ];

        foreach ($lps as $lps) {
            \App\Models\LPS::create($lps);
        }
    }
}
