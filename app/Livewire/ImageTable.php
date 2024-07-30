<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;
use Livewire\WithPagination;

class ImageTable extends Component
{
    use WithPagination;

    protected $listeners = ['refreshImage' => '$refresh'];

    public $isDeleteModalOpen = false;
    public $deletingId = null;

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

    public function deleteImage()
    {
        $image = Image::find($this->deletingId);

        try {
            $image->delete();
            session()->flash('message', 'Image berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus image.');
        }

        $this->closeDeleteModal();
    }

    public function render()
    {
        $images = Image::all();

        return view('livewire.image-table', [
            'images' => Image::paginate(5),
        ]);
    }
}
