<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrolFitur extends Model
{
    use HasFactory;

    protected $table = 'kontrol_fitur';

    protected $fillable = [
        'nama_fitur',
        'kode_fitur',
        'deskripsi',
        'status'
    ];
}
