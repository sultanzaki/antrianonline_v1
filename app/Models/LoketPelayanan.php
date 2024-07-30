<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Layanan;
use App\Models\PelayananAktif;

class LoketPelayanan extends Model
{
    use HasFactory;

    protected $table = 'loket_pelayanan';
    protected $primaryKey = 'id_loket';
    protected $fillable = ['layanan_id', 'nama_loket', 'kode_pelayanan'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    public function pelayananAktif()
    {
        return $this->hasOne(PelayananAktif::class, 'id_loket', 'id_loket');
    }

    public function userLoketPelayanan()
    {
        return $this->hasMany(UserLoketPelayanan::class, 'id_loket', 'id_loket');
    }
}
