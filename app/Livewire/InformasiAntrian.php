<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KontrolFitur;

class InformasiAntrian extends Component
{
    public $features;

    public function mount()
    {
        $this->features = KontrolFitur::all();
    }

    public function toggleFeature($featureId)
    {
        $feature = KontrolFitur::find($featureId);
        $feature->status = $feature->status === 'aktif' ? 'nonaktif' : 'aktif';
        $feature->save();
        
        $this->features = KontrolFitur::all();

        // Emit an event when a feature status changes
        $this->dispatch('refreshFeature');
    }

    public function render()
    {
        return view('livewire.informasi-antrian');
    }
}
