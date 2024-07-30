<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPS extends Model
{
    use HasFactory;

    protected $table = 'lps';

    protected $fillable = [
        'nama_rate',
        'rate',
    ];
}
