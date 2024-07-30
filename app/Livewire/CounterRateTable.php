<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CounterRate;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log; // Import Facade Log

class CounterRateTable extends Component
{
    use WithPagination;

    public $isEditModalOpen = false;
    public $editingTiering = null;
    public $editingRates = [];

    protected $rules = [
        'editingRates.*' => 'numeric',
    ];

    protected $messages = [
        'editingRates.*.numeric' => 'Rate harus berupa angka.',
    ];

    public function openEditPopup($tiering)
    {
        $this->editingTiering = $tiering;
        $rates = CounterRate::where('tiering', $tiering)->get();
        $this->editingRates = $rates->pluck('rate', 'duration')->toArray();
        $this->isEditModalOpen = true;
    }

    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->editingTiering = null;
        $this->editingRates = [];
        $this->resetValidation();
    }

    public function updateCounterRates()
    {
        $this->validate();
        
        try {
            foreach ($this->editingRates as $duration => $rate) {
                CounterRate::where('tiering', $this->editingTiering)
                    ->where('duration', $duration)
                    ->update(['rate' => $rate]);
            }

            $this->closeEditModal();
            session()->flash('message', 'Data Counter Rate berhasil diperbarui.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function render()
    {
        $counterRates = CounterRate::all()->groupBy('tiering');

        return view('livewire.counter-rate-table', [
            'counterRates' => $counterRates,
        ]);
    }
}
