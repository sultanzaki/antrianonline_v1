<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 10 dummy videos
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Video::create([
                'title' => "Video $i",
                'description' => "Description for Video $i",
                'url' => "videos/video-$i.mp4",
            ]);
        }
    }
}
