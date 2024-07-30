<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Support\Facades\Log;

class PlaylistManager extends Component
{
    public $playlists;
    public $selectedPlaylist = null;
    public $videos = [];

    public function mount()
    {
        $this->playlists = Playlist::all();
        $this->videos = collect();
    }

    public function updatedSelectedPlaylist($value)
    {
        if ($value) {
            $playlist = Playlist::with('videos')->find($value);
            if ($playlist) {
                $this->videos = $playlist->videos->map(function($video) {
                    return [
                        'id' => $video->id,
                        'title' => $video->title,
                        'position' => $video->pivot->position,
                    ];
                });
                \Log::info('Videos for playlist ' . $playlist->name, $this->videos->toArray());
            } else {
                $this->videos = collect();
            }
        } else {
            $this->videos = collect();
        }
        \Log::info('Selected Playlist: ' . $value);
        \Log::info('Video Count: ' . $this->videos->count());
    }


    public function loadVideos()
    {
        if ($this->selectedPlaylist) {
            $playlist = Playlist::with('videos')->find($this->selectedPlaylist);
            if ($playlist) {
                $this->videos = $playlist->videos->map(function($video) {
                    return [
                        'id' => $video->id,
                        'title' => $video->title,
                        'position' => $video->pivot->position,
                    ];
                });
            }
        }
    }

    public function updatePosition($videoId, $newPosition)
    {
        $playlist = Playlist::find($this->selectedPlaylist);
        $playlist->videos()->updateExistingPivot($videoId, ['position' => $newPosition]);
        $this->loadVideos();
    }

    public function removeVideo($videoId)
    {
        $playlist = Playlist::find($this->selectedPlaylist);
        $playlist->videos()->detach($videoId);
        $this->loadVideos();
        $this->dispatch('refreshVideo');
    }

    public function render()
    {
        return view('livewire.playlist-manager');
    }
}
