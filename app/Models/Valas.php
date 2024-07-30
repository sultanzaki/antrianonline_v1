<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valas extends Model
{
    use HasFactory;

    protected $table = 'valas';

    protected $primaryKey = 'id';

    protected $fillable = ['kode_valas', 'kode_iso_valas', 'beli', 'jual', 'status'];
}
