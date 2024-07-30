<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAntrian extends Model
{
    use HasFactory;

    protected $table = 'riwayat_antrian';

    protected $fillable = [
        'nama_loket',
        'nomor_antrian',
        'nama_layanan',
    ];
}
