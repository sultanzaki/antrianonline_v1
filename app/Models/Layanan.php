<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NomorAntrian;
use App\Models\loketPelayanan;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'id_pelayanan';
    protected $fillable = ['kode_pelayanan', 'nama_pelayanan', 'deskripsi'];

    public function nomorAntrian()
    {
        return $this->hasMany(NomorAntrian::class, 'id_pelayanan', 'id_pelayanan');
    }

    public function loketPelayanan()
    {
        return $this->hasMany(loketPelayanan::class, 'id_pelayanan', 'id_pelayanan');
    }
}
