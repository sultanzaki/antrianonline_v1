<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loket = [
            [
                'id_pelayanan' => 1,
                'nama_loket' => 'Loket 1',
            ],
            [
                'id_pelayanan' => 1,
                'nama_loket' => 'Loket 2',
            ],
            [
                'id_pelayanan' => 2,
                'nama_loket' => 'Loket 3',
            ],
            [
                'id_pelayanan' => 2,
                'nama_loket' => 'Loket 4',
            ],
            [
                'id_pelayanan' => 3,
                'nama_loket' => 'Loket 5',
            ],
            [
                'id_pelayanan' => 3,
                'nama_loket' => 'Loket 6',
            ],
        ];

        foreach ($loket as $data) {
            \App\Models\LoketPelayanan::create($data);
        }
    }
}
