<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;
use Livewire\WithFileUploads;

class ImageForm extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $gambar;

    public function saveImage()
    {
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'gambar' => 'required|mimes:jpg,jpeg,png|max:10240',
        ]);

        $path = $this->gambar->store('images', 'public');

        Image::create([
            'title' => $this->title,
            'description' => $this->description,
            'url' => $path,
        ]);

        session()->flash('message', 'Gambar berhasil diupload.');
        $this->dispatch('refreshImage');

        $this->reset(['title', 'description', 'gambar']);
    }

    public function render()
    {
        return view('livewire.image-form');
    }
}
