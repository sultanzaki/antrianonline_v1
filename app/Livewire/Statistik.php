<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NomorAntrian;

class Statistik extends Component
{
    public function render()
    {
        $totalNomorAntrian = NomorAntrian::whereDate('created_at', date('Y-m-d'))->count();
        $totalNomorAntrianTeller = NomorAntrian::where('id_pelayanan', 1)->whereDate('created_at', date('Y-m-d'))->count();
        $totalNomorAntrianCS = NomorAntrian::where('id_pelayanan', 2)->whereDate('created_at', date('Y-m-d'))->count();


        return view('livewire.statistik', [
            'totalNomorAntrian' => $totalNomorAntrian,
            'totalNomorAntrianTeller' => $totalNomorAntrianTeller,
            'totalNomorAntrianCS' => $totalNomorAntrianCS,
        ]);
    }
}
