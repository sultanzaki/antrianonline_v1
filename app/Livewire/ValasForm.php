<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Valas;

class ValasForm extends Component
{
    public $kode_iso_valas = '';
    public $kode_valas = '';
    public $buy = '';
    public $sell = '';

    protected $rules = [
        'kode_iso_valas' => 'required|string|max:2',
        'kode_valas' => 'required|string|max:3',
        'buy' => 'required|numeric',
        'sell' => 'required|numeric',
    ];

    protected $messages = [
        'kode_iso_valas.required' => 'Kode ISO Valas harus diisi.',
        'kode_iso_valas.max' => 'Kode ISO Valas maksimal 2 karakter.',
        'kode_valas.required' => 'Kode Valas harus diisi.',
        'kode_valas.max' => 'Kode Valas maksimal 3 karakter.',
        'buy.required' => 'Harga beli harus diisi.',
        'buy.numeric' => 'Harga beli harus berupa angka.',
        'sell.required' => 'Harga jual harus diisi.',
        'sell.numeric' => 'Harga jual harus berupa angka.',
    ];

    public function saveValas()
    {
        $validatedData = $this->validate();

        if (Valas::count() >= 10) {
            $this->addError('limit', 'Data valas sudah mencapai batas maksimal.');
            return;
        }

        try {
            Valas::create([
                'kode_iso_valas' => $validatedData['kode_iso_valas'],
                'kode_valas' => $validatedData['kode_valas'],
                'beli' => $validatedData['buy'],
                'jual' => $validatedData['sell'],
                'status' => "aktif"
            ]);

            session()->flash('message', 'Data valas berhasil disimpan.');
            $this->reset(['kode_iso_valas', 'kode_valas', 'buy', 'sell']);
            $this->dispatch('refreshValas');
        } catch (\Exception $e) {
            $this->addError('saveValas', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.valas-form');
    }
}