<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoketPelayanan extends Model
{
    use HasFactory;

    protected $table = 'user_loket_pelayanan';

    protected $primaryKey = 'id';
    protected $fillable = ['id_user', 'id_loket'];
    
    public function loketPelayanan()
    {
        return $this->belongsTo(LoketPelayanan::class, 'id_loket', 'id_loket');
    }
}
