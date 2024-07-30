<div>
    <div class="mb-4">
        <label for="playlist" class="block text-sm font-medium text-gray-700 mb-2">Pilih Playlist</label>
        <select id="playlist" wire:model.live="selectedPlaylist" wire:change="loadVideos" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value="">-- Pilih Playlist --</option>
            @foreach($playlists as $playlist)
                <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
            @endforeach
        </select>
    </div>

    @if(!empty($videos))
        <div class="mt-4">
        <table class="min-w-full divide-y shadow-md sm:rounded-lg divide-gray-200 sm:table-fixed">
            <thead class="bg-gray-50 rounded-t-lg">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Urutan Video</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if (count($videos) === 0)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm hidden sm:table-cell text-center" colspan="3">Tidak ada video dalam playlist</td>
                    </tr>
                @endif
                @foreach ($videos as $video)
                    <tr class="hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm hidden sm:table-cell">{{ $video['title'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm hidden sm:table-cell">
                            <input type="number" value="{{ $video['position'] }}" wire:change="updatePosition({{ $video['id'] }}, $event.target.value)" class="border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md ">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="removeVideo({{ $video['id'] }})" class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @else
        <div class="mt-4">
            <h3 class="text-lg font-medium">No videos in playlist</h3>
        </div>
    @endif
</div>
