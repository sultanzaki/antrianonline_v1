<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Antrian Online Bank BJB</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <livewire:styles />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        
        <style>
            body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-image: url("{{ asset('assets/images/bg.png') }}");
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            }
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-down {
                animation: fadeInDown 0.5s ease-out;
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.5s ease-out;
            }

            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.7;
                }
            }

            .group:hover .group-hover\:animate-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            .overflow-hidden {
                overflow: hidden;
            }
            .uk-section {
                box-sizing: border-box;
                display: flow-root;
                padding-bottom: 40px;
                padding-top: 40px;
            }

            .is-footerbar {
                display: grid;
                grid-template-columns: 1fr .5fr .5fr;
            }

            .is-footerbar-area {
                height: 6px;
                width: 100%;
            }

            .is-footerbar-start {
                background-color: #0b79ca;
            }

            .is-footerbar-middle {
                background-color: #0078ff;
            }

            .is-footerbar-end {
                background-color: #edc817;
            }
        </style>

    </head>
    <body class="antialiased bg-blue-900 text-white">
        <livewire:touchsreen-antrian />

        <livewire:scripts />
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('6e7fbb5f101ebb08fe89', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('panggil-channel');
            channel.bind('panggil-event', function(data) {
                // Assuming data received is in the format { nomor_antrian: '#A0051#' }
                console.log('Original Pusher data:', data);

                // Transform the data to the desired format
                var formattedData = [{ nomor_antrian: data.nomor_antrian.replace(/#/g, '') }];
                console.log('Formatted Pusher data:', formattedData);

                // Send the formatted data to Electron
                if (window.sendSerialData) {
                    console.log('Sending formatted Pusher data to Electron:', formattedData);
                    window.sendSerialData(formattedData);
                }
            });
        </script>

        <script>
        document.addEventListener('livewire:init', function () {
            Livewire.on('send-serial-data', function (data) {
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
    </body>
</html>
