<div>
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
    <form wire:submit="saveImage">
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
            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
            <input type="file" wire:model.live="gambar" id="gambar" name="gambar" 
                class="block w-full px-4 py-3 rounded-md bg-gray-50 border-transparent focus:border-blue-500 focus:bg-white focus:ring-0 transition duration-200 ease-in-out shadow-sm hover:shadow-md" />
            <div wire:loading wire:target="gambar">Uploading...</div>
            @error('gambar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <div class="text-right">
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Simpan
            </button>
        </div>
    </form>
</div>
