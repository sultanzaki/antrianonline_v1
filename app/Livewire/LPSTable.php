<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LPS;

class LPSTable extends Component
{
    public $lpss;

    public $isEditModalOpen = false;
    public $isDeleteModalOpen = false;
    public $editingRate = null;
    public $editingRates = [];
    public $rates = [];
    public $editingLps = [];
    public $editingId = null;

    protected $rules = [
        'editingRates.*' => 'required|numeric',
    ];

    protected $messages = [
        'editingRates.*.required' => 'Rate harus diisi.',
        'editingRates.*.numeric' => 'Rate harus berupa angka.',
    ];

    public function openEditModal($id)
    {
        $this->editingId = $id;
        $this->editingLps = LPS::find($id)->toArray();
        $this->isEditModalOpen = true;
    }

    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->editingId = null;
        $this->editingLps = [];
        $this->resetValidation();
    }

    public function updateLPS()
    {
        $this->validate();
        
        try {
            LPS::find($this->editingId)->update($this->editingLps);
            session()->flash('message', 'Data LPS berhasil diperbarui.');
            $this->closeEditModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function loadRates()
    {
        $lpss = LPS::all();
        foreach ($lpss as $lps) {
            $this->rates[$lps->id] = $lps->rate;
        }
    }

    public function render()
    {
        $lpss = LPS::all();

        return view('livewire.l-p-s-table', [
            'lpss' => $lpss
        ]);
    }

    public function mount()
    {
        $this->lpss = LPS::all();
        $this->loadRates();
    }
}
