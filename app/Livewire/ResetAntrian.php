<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NomorAntrian;
use App\Models\PelayananAktif;
use Carbon\Carbon;


class ResetAntrian extends Component
{
    public function resetAntrian()
    {
        NomorAntrian::whereDate('created_at', Carbon::today())->delete();
        PelayananAktif::whereDate('created_at', Carbon::today())->delete();

        session()->flash('message', 'Antrian berhasil direset');
    }

    public function render()
    {
        return view('livewire.reset-antrian');
    }
}
