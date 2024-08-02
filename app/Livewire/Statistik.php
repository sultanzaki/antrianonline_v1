<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NomorAntrian;
use App\Models\WaktuPelayanan;
use App\Models\Layanan;

class Statistik extends Component
{
    public $totalNomorAntrian;
    public $totalNomorAntrianTeller;
    public $totalNomorAntrianCS;
    public $rataRataWaktuPelayanan;
    public $antrianPerJam;
    public $waktuTungguPerJam;
    public $waktuTungguPerLayanan;
    public $antrianPerLayanan;
    public $layanan;
    

    public function mount()
    {
        $this->totalNomorAntrian = NomorAntrian::whereDate('created_at', date('Y-m-d'))->count();
        $this->totalNomorAntrianTeller = NomorAntrian::where('id_pelayanan', 1)->whereDate('created_at', date('Y-m-d'))->count();
        $this->totalNomorAntrianCS = NomorAntrian::where('id_pelayanan', 2)->whereDate('created_at', date('Y-m-d'))->count();
        $this->rataRataWaktuPelayanan = round(WaktuPelayanan::avg('total_waktu') / 60, 2);

        $this->antrianPerJam = NomorAntrian::selectRaw('HOUR(created_at) as hour, id_pelayanan, COUNT(*) as count')
            ->whereDate('created_at', date('Y-m-d'))
            ->where('status', 1)
            ->groupBy('hour', 'id_pelayanan')
            ->get()
            ->groupBy('hour')
            ->map(function ($hourGroup) {
                return $hourGroup->pluck('count', 'id_pelayanan');
            })
            ->toArray();
    
        $this->layanan = Layanan::all();

        $this->waktuTungguPerJam = WaktuPelayanan::selectRaw('HOUR(waktu_mulai) as hour, AVG(TIMESTAMPDIFF(MINUTE, waktu_mulai, waktu_selesai)) as avg_wait_time')
            ->whereDate('waktu_mulai', date('Y-m-d'))
            ->groupBy('hour')
            ->pluck('avg_wait_time', 'hour')
            ->toArray();

        $this->antrianPerLayanan = NomorAntrian::selectRaw('layanan.nama_pelayanan, COUNT(nomor_antrian) as count')
            ->join('layanan', 'nomor_antrian.id_pelayanan', '=', 'layanan.id_pelayanan')
            ->whereDate('nomor_antrian.created_at', date('Y-m-d'))
            ->where('nomor_antrian.status', 1)
            ->groupBy('layanan.nama_pelayanan')
            ->pluck('count', 'nama_pelayanan')
            ->toArray();

        $this->waktuTungguPerLayanan = WaktuPelayanan::selectRaw('layanan.nama_pelayanan, AVG(TIMESTAMPDIFF(MINUTE, waktu_mulai, waktu_selesai)) as avg_wait_time')
            ->join('nomor_antrian', 'waktu_pelayanan.id_antrian', '=', 'nomor_antrian.id_antrian')
            ->join('layanan', 'nomor_antrian.id_pelayanan', '=', 'layanan.id_pelayanan')
            ->whereDate('waktu_pelayanan.waktu_mulai', date('Y-m-d'))
            ->groupBy('layanan.id_pelayanan', 'layanan.nama_pelayanan')
            ->pluck('avg_wait_time', 'nama_pelayanan')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.statistik', [
            'totalNomorAntrian' => $this->totalNomorAntrian,
            'totalNomorAntrianTeller' => $this->totalNomorAntrianTeller,
            'totalNomorAntrianCS' => $this->totalNomorAntrianCS,
            'rataRataWaktuPelayanan' => $this->rataRataWaktuPelayanan,
            'antrianPerJam' => $this->antrianPerJam,
            'waktuTungguPerJam' => $this->waktuTungguPerJam,
            'antrianPerLayanan' => $this->antrianPerLayanan,
            'layanan' => $this->layanan,
            'waktuTungguPerLayanan' => $this->waktuTungguPerLayanan,
        ]);
    }
}
