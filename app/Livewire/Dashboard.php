<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Valas;
use App\Models\Video;
use App\Models\Playlist;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;


class Dashboard extends Component
{
    use WithFileUploads;

    public $activeTab = 'statistik';

    public $title;
    public $description;
    public $video;

    public $selectedPlaylist;
    public $selectedVideo;

    protected $rules = [
        'kode_valas' => 'required|string|max:3',
        'buy' => 'required|numeric',
        'sell' => 'required|numeric',
    ];

    protected $messages = [
        'kode_valas.required' => 'Kode Valas harus diisi.',
        'kode_valas.max' => 'Kode Valas maksimal 3 karakter.',
        'buy.required' => 'Harga beli harus diisi.',
        'buy.numeric' => 'Harga beli harus berupa angka.',
        'sell.required' => 'Harga jual harus diisi.',
        'sell.numeric' => 'Harga jual harus berupa angka.',
        'video.required' => 'Video harus diisi.',
        'video.mimes' => 'Video harus berformat mp4.',
        'video.max' => 'Video maksimal 100 MB.',
        'selectedPlaylist.required' => 'Playlist harus dipilih.',
        'selectedPlaylist.exists' => 'Playlist tidak ditemukan.',
        'selectedVideo.required' => 'Video harus dipilih.',
        'selectedVideo.exists' => 'Video tidak ditemukan.',
    ];

    public function saveVideo()
    {
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'video' => 'required|mimes:mp4',
        ]);

        $path = $this->video->store('videos', 'public');

        Video::create([
            'title' => $this->title,
            'description' => $this->description,
            'url' => $path,
        ]);

        session()->flash('message', 'Video berhasil diupload.');

        $this->reset(['title', 'description', 'video']);
    }

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

        $this->reset(['gambar']);
    }

    public function addVideoToPlaylist()
    {
        $this->validate([
            'selectedPlaylist' => 'required|exists:playlists,id',
            'selectedVideo' => 'required|exists:videos,id',
        ]);

        $playlist = Playlist::find($this->selectedPlaylist);
        
        // Hitung posisi terakhir di playlist
        $lastPosition = $playlist->videos()->count();

        try {
            $playlist->videos()->attach($this->selectedVideo, ['position' => $lastPosition + 1]);
            session()->flash('message', 'Video berhasil ditambahkan ke playlist.');
            $this->dispatch('refreshVideo');
        } catch (\Exception $e) {
            $this->addError('selectedVideo', 'Video sudah berada di dalam playlist.');
        }

        $this->reset(['selectedPlaylist', 'selectedVideo']);
    }

    public function render()
    {
        $playlists = Playlist::all();
        $videos = Video::all();

        return view('livewire.dashboard', [
            'playlists' => $playlists,
            'videos' => $videos,
        ]);
    }

    public function changeTab($tab)
    {
        $this->activeTab = $tab;
    }
}
