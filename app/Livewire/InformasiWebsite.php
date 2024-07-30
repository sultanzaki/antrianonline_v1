<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KontrolInformasi;

class InformasiWebsite extends Component
{
    public $pesan;
    public $kontrol_informasi;

    public function mount()
    {
        $this->kontrol_informasi = KontrolInformasi::first();
        $this->pesan = $this->kontrol_informasi->pesan;
    }

    public function updatePesan()
    {
        $this->kontrol_informasi->pesan = $this->pesan;
        $this->kontrol_informasi->save();

        $this->dispatch('refreshPesan')->to('TVAntrian');

        session()->flash('message', 'Pesan berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.informasi-website');
    }
}
