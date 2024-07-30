<div>
    <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'statistik' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}" 
                        wire:click="changeTab('statistik')" type="button">
                    Statistik
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'informasi' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}" 
                        wire:click="changeTab('informasi')" type="button">
                    Informasi Antrian
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'video' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                        wire:click="changeTab('video')" type="button">
                    Video
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'valas' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                        wire:click="changeTab('valas')" type="button">
                    Valas
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'counter_rate' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                        wire:click="changeTab('counter_rate')" type="button">
                    Counter Rate
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'lps' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                        wire:click="changeTab('lps')" type="button">
                    LPS
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'iklan' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                        wire:click="changeTab('iklan')" type="button">
                    Iklan
                </button>
            </li>
        </ul>
    </div>

    <div class="p-4">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <button type="button" @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-green-500 hover:text-green-700">
                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </button>
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif
        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <button type="button" @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-red-500 hover:text-red-700">
                    <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </button>
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($activeTab === 'statistik')
            <livewire:statistik />
        @elseif ($activeTab === 'informasi')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <livewire:informasi-website />
                </div>
                <div>
                    <livewire:informasi-antrian />
                </div>  
                <div>
                    <livewire:valas-scraper />
                </div>  
            </div>
        @elseif ($activeTab === 'video')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Tambah Video</h3>
                    <!-- form upload video -->
                    <form wire:submit="saveVideo">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                            <input type="text" wire:model.live="title" id="title" name="title" 
                                class="block w-full px-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" />
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <!-- description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea wire:model.live="description" id="description" name="description" rows="3" 
                                class="block w-full px-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="video" class="block text-sm font-medium text-gray-700 mb-1">Video</label>
                            <input type="file" wire:model.live="video" id="video" name="video" 
                                class="block w-full px-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" />
                                <div wire:loading wire:target="video">Uploading...</div>
                                @error('video') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="text-right">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Playlist Video</h3>
                    <!-- form add video to playlist -->
                    <form wire:submit="addVideoToPlaylist">
                        <div class="mb-4">
                            <label for="playlist" class="block text-sm font-medium text-gray-700 mb-1">Pilih Playlist</label>
                            <select id="playlist" wire:model.live="selectedPlaylist"
                                class="block w-full px-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md">
                                <option value="">-- Pilih Playlist --</option>
                                @foreach($playlists as $playlist)
                                    <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedPlaylist') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="video" class="block text-sm font-medium text-gray-700 mt-4 mb-1">Pilih Video</label>
                            <select id="video" wire:model.live="selectedVideo" 
                                class="block w-full px-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md">
                                <option value="">-- Pilih Video --</option>
                                @foreach($videos as $video)
                                    <option value="{{ $video->id }}">{{ $video->title }}</option>
                                @endforeach
                            </select>
                            @error('selectedVideo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Playlist Manager</h3>
                    @livewire('playlist-manager')
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Video</h3>
                    <!-- dummy table -->
                    @livewire('video-table')
                </div>
            </div>
        @elseif ($activeTab === 'valas')
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Tambah Valas</h3>
                    <livewire:valas-form />
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Valas</h3>
                    <!-- dummy table -->
                    <livewire:valas-table />
                </div>
            </div>
        @elseif ($activeTab === 'counter_rate')
            <div class="grid grid-cols-1">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Counter Rate</h3>
                    <!-- dummy table -->
                    <livewire:counter-rate-table />
                </div>
            </div>
        @elseif ($activeTab === 'lps')
            <div class="grid grid-cols-1">
                <div>
                    <h3 class="text-lg font-semibold mb-2">LPS
                    <!-- dummy table -->
                    <livewire:l-p-s-table />
                </div>
            </div>
        @else
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-lg font-semibold mb-2">Tambah Iklan</h3>
                    <!-- form upload video -->
                    <livewire:image-form />
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Iklan</h3>
                    <!-- dummy table -->
                    <livewire:image-table />
                </div>
            </div>
        @endif
    </div>
</div>