<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\loketPelayanan;
use App\Models\NomorAntrian;

class PelayananAktif extends Model
{
    use HasFactory;

    protected $table = 'pelayanan_aktif';
    protected $primaryKey = 'id_pelayanan_aktif';
    protected $fillable = ['id_loket', 'id_antrian'];

    public function loketPelayanan()
    {
        return $this->belongsTo(loketPelayanan::class, 'id_loket', 'id_loket');
    }

    public function nomorAntrian()
    {
        return $this->belongsTo(NomorAntrian::class, 'id_antrian', 'id_antrian');
    }
}
