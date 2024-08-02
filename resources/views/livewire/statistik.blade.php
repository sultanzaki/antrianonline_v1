<div>
<div>
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
            <p class="text-3xl font-bold text-blue-600">{{ $rataRataWaktuPelayanan }} Menit</p>
        </div>
    </div>
    
    <!-- Grafik -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Grafik Antrian per Jam -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Jumlah Pengunjung per Layanan</h2>
            <canvas id="antrianPerJamChart" class="h-64"></canvas>
        </div>

        <!-- Grafik Waktu Tunggu Rata-rata -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Waktu Tunggu Rata-rata</h2>
            <canvas id="waktuTungguPerJamChart" class="h-64"></canvas>
        </div>

        <!-- Grafik Jumlah Antrian per Layanan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Total Pengunjung</h2>
            <canvas id="antrianPerLayananChart" style="height: 300px;"></canvas>
        </div>

        <!-- Grafik Waktu Pelayanan per Layanan -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Waktu Pelayanan per Layanan</h2>
            <canvas id="waktuPelayananPerLayananChart" style="height: 300px;"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function () {
        var ctx = document.getElementById('antrianPerJamChart').getContext('2d');
        var antrianPerJam = @json($antrianPerJam);
        var layanan = @json($layanan);

        var labels = Object.keys(antrianPerJam).map(hour => hour + ':00');
        var datasets = [];

        var colors = [
            'rgba(11, 129, 202, 1)',  // Blue
            'rgba(237, 200, 23, 1)',  // Red
            'rgba(75, 192, 192, 1)',  // Green
            'rgba(255, 206, 86, 1)',  // Yellow
            'rgba(153, 102, 255, 1)', // Purple
            'rgba(255, 159, 64, 1)'   // Orange
        ];

        layanan.forEach(function(layananItem, index) {
            var data = [];
            labels.forEach(function(label) {
                var hour = parseInt(label.split(':')[0]);
                data.push(antrianPerJam[hour] ? (antrianPerJam[hour][layananItem.id_pelayanan] || 0) : 0);
            });

            datasets.push({
                label: layananItem.nama_pelayanan,
                data: data,
                backgroundColor: colors[index % colors.length],
                borderColor: colors[index % colors.length],
                borderWidth: 1
            });
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Jam'
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pengunjung'
                        }
                    }
                }
            }
        });

        // Grafik Waktu Tunggu Rata-rata per Jam
        var ctxWait = document.getElementById('waktuTungguPerJamChart').getContext('2d');
        var waktuTungguPerJam = @json($waktuTungguPerJam);

        // Menyiapkan data untuk grafik waktu tunggu rata-rata per jam
        var labelsWait = Object.keys(waktuTungguPerJam).map(hour => hour + ':00');
        var dataWait = Object.values(waktuTungguPerJam);

        new Chart(ctxWait, {
            type: 'line',
            data: {
                labels: labelsWait,
                datasets: [{
                    label: 'Waktu Tunggu Rata-rata (menit)',
                    data: dataWait,
                    backgroundColor: 'rgba(237, 200, 23)',
                    borderColor: 'rgba(237, 200, 23, 1)',
                    borderWidth: 1,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: {  // Mengubah y menjadi x karena orientasi horizontal
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jam'
                        }
                    },
                    y: {  // Mengubah x menjadi y
                        title: {
                            display: true,
                            text: 'Waktu Tunggu (Menit)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false  // Menyembunyikan legend karena hanya ada satu dataset
                    },
                },
            }
        });

        // Grafik Jumlah Antrian per Layanan
        var ctxLayanan = document.getElementById('antrianPerLayananChart').getContext('2d');
        var antrianPerLayanan = @json($antrianPerLayanan);

        // Menyiapkan data untuk grafik jumlah antrian per layanan
        var labelsLayanan = Object.keys(antrianPerLayanan);
        var dataLayanan = Object.values(antrianPerLayanan);

        // buat donut chart
        new Chart(ctxLayanan, {
            type: 'doughnut',
            data: {
                labels: labelsLayanan,
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: dataLayanan,
                    backgroundColor: [
                        'rgba(11, 129, 202, 1)',
                        'rgba(237, 200, 23, 1)',
                        'rgba(255, 206, 86, 0.9)',
                        'rgba(75, 192, 192, 0.9)',
                        'rgba(153, 102, 255, 0.9)',
                        'rgba(255, 159, 64, 0.9)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 1.9,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Waktu Pelayanan per Layanan
        var ctxPelayanan = document.getElementById('waktuPelayananPerLayananChart').getContext('2d');
        var waktuPelayananPerLayanan = @json($waktuTungguPerLayanan);

        // Menyiapkan data untuk grafik waktu pelayanan per layanan
        var labelsPelayanan = Object.keys(waktuPelayananPerLayanan);
        var dataPelayanan = Object.values(waktuPelayananPerLayanan);

        // Buat horizontal bar chart dengan nama layanan di sumbu y
        new Chart(ctxPelayanan, {
            type: 'bar',
            data: {
                labels: labelsPelayanan,
                datasets: [{
                    label: 'Waktu Pelayanan (menit)',
                    data: dataPelayanan,
                    backgroundColor: [
                        'rgba(11, 129, 202, 1)',
                        'rgba(237, 200, 23, 1)',
                    ],
                    borderColor: 'rgba(11, 129, 202, 1)',
                    borderWidth: 0
                }]
            },
            options: {
                indexAxis: 'y',  // Mengubah orientasi menjadi horizontal
                responsive: true,
                aspectRatio: 1.5,  // Menyesuaikan rasio aspek untuk tampilan horizontal
                scales: {
                    x: {  // Mengubah y menjadi x karena orientasi horizontal
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Waktu Pelayanan (menit)'
                        }
                    },
                    y: {  // Mengubah x menjadi y
                        title: {
                            display: true,
                            text: 'Nama Layanan'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false  // Menyembunyikan legend karena hanya ada satu dataset
                    },
                }
            }
        });
    });
</script>
</div>
