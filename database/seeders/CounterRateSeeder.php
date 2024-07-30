<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounterRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['tiering' => '< 100 Jt', 'duration' => 1, 'rate' => 2.50],
            ['tiering' => '< 100 Jt', 'duration' => 3, 'rate' => 2.60],
            ['tiering' => '< 100 Jt', 'duration' => 6, 'rate' => 2.70],
            ['tiering' => '< 100 Jt', 'duration' => 12, 'rate' => 2.75],
            ['tiering' => '< 100 Jt', 'duration' => 24, 'rate' => 2.90],

            ['tiering' => '≥ 100 Jt s.d < 500 Jt', 'duration' => 1, 'rate' => 2.50],
            ['tiering' => '≥ 100 Jt s.d < 500 Jt', 'duration' => 3, 'rate' => 2.60],
            ['tiering' => '≥ 100 Jt s.d < 500 Jt', 'duration' => 6, 'rate' => 2.70],
            ['tiering' => '≥ 100 Jt s.d < 500 Jt', 'duration' => 12, 'rate' => 2.75],
            ['tiering' => '≥ 100 Jt s.d < 500 Jt', 'duration' => 24, 'rate' => 2.90],

            ['tiering' => '≥ 500 Jt s.d < 2 M', 'duration' => 1, 'rate' => 2.50],
            ['tiering' => '≥ 500 Jt s.d < 2 M', 'duration' => 3, 'rate' => 2.60],
            ['tiering' => '≥ 500 Jt s.d < 2 M', 'duration' => 6, 'rate' => 2.70],
            ['tiering' => '≥ 500 Jt s.d < 2 M', 'duration' => 12, 'rate' => 2.90],
            ['tiering' => '≥ 500 Jt s.d < 2 M', 'duration' => 24, 'rate' => 2.90],

            ['tiering' => '≥ 2 M', 'duration' => 1, 'rate' => 2.50],
            ['tiering' => '≥ 2 M', 'duration' => 3, 'rate' => 2.60],
            ['tiering' => '≥ 2 M', 'duration' => 6, 'rate' => 2.70],
            ['tiering' => '≥ 2 M', 'duration' => 12, 'rate' => 2.90],
            ['tiering' => '≥ 2 M', 'duration' => 24, 'rate' => 2.90],
        ];

        foreach ($data as $item) {
            \App\Models\CounterRate::create($item);
        }
    }
}
