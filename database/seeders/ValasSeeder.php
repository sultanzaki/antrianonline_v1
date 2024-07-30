<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $valas = [
            ['kode_valas' => 'USD', 'beli' => 14000, 'jual' => 14100, 'status' => 'aktif'],
            ['kode_valas' => 'EUR', 'beli' => 16000, 'jual' => 16100, 'status' => 'aktif'],
            ['kode_valas' => 'JPY', 'beli' => 130, 'jual' => 140, 'status' => 'aktif'],
            ['kode_valas' => 'SGD', 'beli' => 10000, 'jual' => 10100, 'status' => 'aktif'],
            ['kode_valas' => 'MYR', 'beli' => 3000, 'jual' => 3100, 'status' => 'aktif'],
            ['kode_valas' => 'AUD', 'beli' => 10000, 'jual' => 10100, 'status' => 'aktif'],
            ['kode_valas' => 'CNY', 'beli' => 2000, 'jual' => 2100, 'status' => 'aktif'],
            ['kode_valas' => 'HKD', 'beli' => 1800, 'jual' => 1900, 'status' => 'aktif'],
            ['kode_valas' => 'GBP', 'beli' => 18000, 'jual' => 18100, 'status' => 'aktif'],
            ['kode_valas' => 'CHF', 'beli' => 15000, 'jual' => 15100, 'status' => 'aktif'],
            ['kode_valas' => 'NZD', 'beli' => 9500, 'jual' => 9600, 'status' => 'aktif'],
            ['kode_valas' => 'CAD', 'beli' => 10500, 'jual' => 10600, 'status' => 'aktif'],
            ['kode_valas' => 'SEK', 'beli' => 1300, 'jual' => 1400, 'status' => 'aktif'],
            ['kode_valas' => 'DKK', 'beli' => 2000, 'jual' => 2100, 'status' => 'aktif'],
            ['kode_valas' => 'NOK', 'beli' => 1300, 'jual' => 1400, 'status' => 'aktif'],
            ['kode_valas' => 'SAR', 'beli' => 3700, 'jual' => 3800, 'status' => 'aktif'],
            ['kode_valas' => 'AED', 'beli' => 3800, 'jual' => 3900, 'status' => 'aktif'],
            ['kode_valas' => 'KRW', 'beli' => 1200, 'jual' => 1300, 'status' => 'aktif'],
            ['kode_valas' => 'THB', 'beli' => 400, 'jual' => 500, 'status' => 'aktif'],
            ['kode_valas' => 'TWD', 'beli' => 400, 'jual' => 500, 'status' => 'aktif'],
            ['kode_valas' => 'PHP', 'beli' => 300, 'jual' => 400, 'status' => 'aktif'],
            ['kode_valas' => 'INR', 'beli' => 200, 'jual' => 300, 'status' => 'aktif'],
            ['kode_valas' => 'PKR', 'beli' => 100, 'jual' => 200, 'status' => 'aktif'],
            ['kode_valas' => 'BDT', 'beli' => 100, 'jual' => 200, 'status' => 'aktif'],
            ['kode_valas' => 'LKR', 'beli' => 100, 'jual' => 200, 'status' => 'aktif'],
            ['kode_valas' => 'VND', 'beli' => 100, 'jual' => 200, 'status' => 'aktif'],
            ['kode_valas' => 'IDR', 'beli' => 1, 'jual' => 1, 'status' => 'aktif'],
        ];

        foreach ($valas as $valas) {
            \App\Models\Valas::create($valas);
        }

    }
}
