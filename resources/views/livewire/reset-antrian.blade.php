<div>
    <h2 class="text-lg font-bold mb-4">Reset Antrian Manual</h2>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    <!-- keterangan -->
    <p class="text-sm text-gray-500 mb-2">Reset antrian secara manual.</p>
    <button wire:confirm.prompt="Apakah Anda yakin ingin reset antrian?\n\nKetik RESET untuk konfirmasi|RESET" wire:click="resetAntrian" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Reset</button>
</div>