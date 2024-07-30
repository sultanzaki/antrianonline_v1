<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Valas;
use Livewire\WithPagination;

class ValasTable2 extends Component
{
    use WithPagination;

    public $editingId = null;
    public $editingValas = [];
    public $isEditModalOpen = false;
    public $isDeleteModalOpen = false;
    public $deletingId = null;

    protected $rules = [
        'editingValas.kode_valas' => 'required|string|max:3',
        'editingValas.kode_iso_valas' => 'required|string|max:2',
        'editingValas.beli' => 'required|numeric',
        'editingValas.jual' => 'required|numeric',
    ];

    protected $messages = [
        'editingValas.kode_iso_valas.required' => 'Kode ISO Valas harus diisi.',
        'editingValas.kode_iso_valas.max' => 'Kode ISO Valas maksimal 2 karakter.',
        'editingValas.kode_valas.required' => 'Kode Valas harus diisi.',
        'editingValas.kode_valas.max' => 'Kode Valas maksimal 3 karakter.',
        'editingValas.beli.required' => 'Harga beli harus diisi.',
        'editingValas.beli.numeric' => 'Harga beli harus berupa angka.',
        'editingValas.jual.required' => 'Harga jual harus diisi.',
        'editingValas.jual.numeric' => 'Harga jual harus berupa angka.',
    ];

    public function openEditModal($id)
    {
        $this->editingId = $id;
        $this->editingValas = Valas::find($id)->toArray();
        $this->isEditModalOpen = true;
    }

    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->editingId = null;
        $this->editingValas = [];
        $this->resetValidation();
    }

    public function openDeleteModal($id)
    {
        $this->deletingId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->deletingId = null;
    }

    public function deleteValas()
    {
        Valas::find($this->deletingId)->delete();
        $this->closeDeleteModal();
    }

    public function updateValas()
    {
        $this->validate();

        try {
            Valas::find($this->editingId)->update($this->editingValas);
            $this->closeEditModal();
        } catch (\Exception $e) {
            $this->addError('editingValas.kode_valas', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.valas-table2' , [
            'valas' => Valas::paginate(6),
        ]);
    }
}
