<div>
<div class="">
<!-- Metrik Utama -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-2 text-gray-700">Total Pengunjung</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalNomorAntrian }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-2 text-gray-700">Total Pengunjung Teller</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalNomorAntrianTeller }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-2 text-gray-700">Total Pengunjung CS</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalNomorAntrianCS }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-2 text-gray-700">Rata-rata Menunggu</h2>
            <p class="text-3xl font-bold text-blue-600">15 menit</p>
        </div>
    </div>
    
    <!-- Grafik -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Grafik Antrian per Jam -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Antrian per Jam</h2>
            <div class="h-64 bg-gray-200 flex items-center justify-center">
                <p class="text-gray-500">Grafik Antrian per Jam</p>
            </div>
        </div>
        
        <!-- Grafik Waktu Tunggu Rata-rata -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Waktu Tunggu Rata-rata</h2>
            <div class="h-64 bg-gray-200 flex items-center justify-center">
                <p class="text-gray-500">Grafik Waktu Tunggu Rata-rata</p>
            </div>
        </div>
    </div>
</div>
</div>
