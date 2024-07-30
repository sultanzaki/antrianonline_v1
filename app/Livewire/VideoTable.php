<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use Livewire\WithPagination;

class VideoTable extends Component
{
    use WithPagination;

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

    public function deleteVideo()
    {
        $video = Video::find($this->deletingId);
        $video->playlists()->detach();

        try {
            $video->delete();
            session()->flash('message', 'Video berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus video.');
        }

        $this->closeDeleteModal();
    }

    public function render()
    {
        return view('livewire.video-table', [
            'videos' => Video::paginate(5)
        ]);
    }
}
