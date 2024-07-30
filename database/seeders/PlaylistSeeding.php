<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaylistSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // playlist just name
        $playlists = [
            'Playlist 1',
            'Playlist 2',
            'Playlist 3',
        ];

        foreach ($playlists as $playlist) {
            \App\Models\Playlist::create([
                'name' => $playlist,
            ]);
        }
    }
}
