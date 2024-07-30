<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Layanan;
use App\Models\LoketPelayanan;
use App\Models\PelayananAktif;

class NomorAntrian extends Model
{
    use HasFactory;

    protected $table = 'nomor_antrian';
    protected $primaryKey = 'id_antrian';
    protected $fillable = ['layanan_id', 'nomor_antrian', 'status', 'id_pelayanan'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_pelayanan', 'id_pelayanan');
    }

    public function loketPelayanan()
    {
        return $this->hasOne(LoketPelayanan::class, 'id_loket', 'id_loket');
    }

    public function pelayananAktif()
    {
        return $this->hasOne(PelayananAktif::class, 'id_antrian', 'id_antrian');
    }
}
