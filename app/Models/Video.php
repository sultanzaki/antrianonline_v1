<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Playlist;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $primaryKey = 'id';

    protected $fillable = ['title', 'description', 'url'];

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_video')
                    ->withPivot('position');
    }
}
