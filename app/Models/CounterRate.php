<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterRate extends Model
{
    use HasFactory;

    protected $table = 'counter_rate';

    protected $fillable = [
        'tiering',
        'duration',
        'rate',
        'status',
    ];

}
