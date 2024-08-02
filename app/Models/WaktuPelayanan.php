<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPelayanan extends Model
{
    use HasFactory;

    protected $table = 'waktu_pelayanan';

    protected $fillable = [
        'id_antrian',
        'waktu_mulai',
        'waktu_selesai',
        'total_waktu',
    ];
}
