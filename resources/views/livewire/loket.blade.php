<div>
    @if (session()->has('message'))
            <div wire:ignore x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
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
            <div wire:ignore x-data="{ show: true }" x-show="show" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
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
    <div class="max-w-6xl mt-6 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Loket Name Card -->
            <div class="bg-white shadow-md rounded-xl py-2 px-6 border-l-4 border-blue-500">
                <h2 class="text-lg font-semibold text-gray-600 mb-2">Loket</h2>
                <p class="text-3xl font-bold text-gray-800">{{ $loket->loketPelayanan->nama_loket }}</p>
            </div>

            <!-- Sisa Antrian Card -->
            <div wire:poll.2000ms="refreshSisaAntrian">
                <div class="bg-white shadow-md rounded-xl py-2 px-6 border-l-4 border-yellow-500">
                    <h2 class="text-lg font-semibold text-gray-600 mb-2">Sisa Antrian</h2>
                    <p class="text-3xl font-bold text-gray-800">{{ $sisaAntrian }}</p>
                </div>
            </div>

            <!-- Antrian yang Sedang Dilayani Card -->
            <div wire:poll.2000ms="refreshAntrianDilayani">
                <div class="bg-white shadow-md rounded-xl py-2 px-6 border-l-4 border-green-500">
                    <h2 class="text-lg font-semibold text-gray-600 mb-2">Antrian yang Sedang Dilayani</h2>
                    <p class="text-3xl font-bold text-gray-800">{{ $antrianDilayani }}</p>
                </div>
            </div>
        </div>

        <!-- create a card for instruction -->
        <div wire:ignore x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <button type="button" @click="show = false" class="absolute top-0 right-0 mt-2 mr-2 text-green-500 hover:text-green-700">
                <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
            <strong class="font-bold">Instruksi</strong><br>
            <span>1. Tekan <button class="text-xs px-4 py-1 bg-yellow-500 text-white rounded">Ulangi</button> untuk mengulangi antrian yang sedang dilayani.</span><br>
            <span>2. Tekan <button class="text-xs px-4 py-1 bg-green-500 text-white rounded">Selesai</button> untuk menyelesaikan antrian yang sedang dilayani.</span><br>
            <span>3. Tekan <button class="text-xs px-4 py-1 bg-blue-500 text-white rounded">Panggil</button> untuk memanggil antrian selanjutnya.</span><br><br>
            <span>Anda tidak dapat menekan tombol <button class="text-xs px-4 py-1 bg-blue-500 text-white rounded">Panggil</button> sebelum menyelesaikan antrian yang sedang dilayani.</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <button wire:click="repeatQueue({{ $loket->id_loket }})" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-6 px-4 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 text-2xl flex items-center justify-center">
                Ulangi
            </button>
            <button wire:click="finishQueue({{ $loket->id_loket }})" class="bg-green-500 hover:bg-green-600 text-white font-bold py-6 px-4 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 text-2xl flex items-center justify-center">
                Selesai
            </button>
            <button wire:click="nextQueue({{ $loket->id_loket }})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-6 px-4 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 text-2xl flex items-center justify-center">
                Panggil
            </button>
        </div>
        <script>
            document.addEventListener('livewire:init', function () {
                Livewire.on('send-serial-data-loket', function (data) {
                    if (window.sendSerialData) {
                        console.log('Sending data from web:', data);
                        window.sendSerialData(data);
                    } else {
                        console.error('Fungsi sendSerialData tidak tersedia');
                    }
                });
            });
        </script>
        <script>
        // Periksa apakah electronAPI tersedia
        if (window.electronAPI) {
            console.log('Electron API tersedia');

            // Tangani status serial
            window.electronAPI.onSerialStatus((event, status) => {
                console.log('Raw Status Serial:', status); // Log status mentah
                if (status && typeof status === 'object' && status.message) {
                    console.log('Status Serial:', status.message);
                    // Di sini Anda bisa memperbarui UI untuk menampilkan status koneksi
                    document.getElementById('statusSerial').textContent = status.message;
                } else {
                    console.error('Status tidak valid:', status);
                }
            });

            // Fungsi untuk mengirim data serial
            window.sendSerialData = function(data) {
                console.log('Sending data:', data);
                window.electronAPI.sendSerialData(data);
            };
        } else {
            console.error('Electron API tidak tersedia');
            // Fallback untuk browser biasa jika diperlukan
        }

        // Tambahkan ini untuk debugging
        console.log('Window object:', window);
        console.log('electronAPI object:', window.electronAPI);
        </script>
    </div>
</div>
