<div>
    <h2 class="text-lg font-bold mb-4">Sinkronisasi Valas Pusat Manual</h2>
    @if ($message)
        <div class="mt-3 alert {{ strpos($message, 'error') !== false ? 'alert-danger' : 'alert-success' }}">
            {{ $message }}
        </div>
    @endif
    <!-- keterangan -->
    <p class="text-sm text-gray-500 mb-2">Sinkronisasi data valas pusat secara manual.</p>
    <button wire:click="scrape" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Sinkronisasi</button>
</div>