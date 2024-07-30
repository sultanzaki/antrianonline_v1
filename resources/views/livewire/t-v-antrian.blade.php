<div class="bg-blue-900 text-white">
<div class="container mx-auto">
        <!-- Navbar with logo -->
        <nav class="flex items-center justify-between py-2">
            <a href="#" class="flex items-center">
                <img src="{{ asset('assets/images/logo.png') }}" class="h-16" alt="logo">
            </a>
            <div wire:poll.1000ms="updateDateTime">
                <div class="text-right">
                    <p class="font-bold text-lg">BJB KCP Kadipaten</p>
                    <p class="font-bold text-base" wire:key="date">{{ $date }}</p>
                    <script>
                    document.addEventListener('livewire:init', function () {
                        let timeElement = document.querySelector('[wire\\:key="time"]');
                        
                        function updateClientTime() {
                            let now = new Date();
                            timeElement.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
                        }

                        setInterval(updateClientTime, 1000);
                    });
                </script>
                </div>
            </div>
        </nav>
        <hr class="border-t-4 border-white mb-2">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <!-- Video -->
                <div class="mb-2">
                @if ($playlist && count($videos) > 0)
                    <div class="relative w-full pt-[56.25%] bg-black rounded-md">
                        <video id="videoPlayer" class="absolute top-0 left-0 w-full h-full transition-opacity duration-500 ease-in-out fade-in rounded-md" autoplay muted>
                            <source src="{{ asset('storage/' . $videos[0]->url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var videos = @json($videos->pluck('url'));
                            var currentVideo = 0;
                            var videoPlayer = document.getElementById('videoPlayer');
                            var videoSource = videoPlayer.querySelector('source');

                            function fadeToNextVideo() {
                                videoPlayer.classList.remove('fade-in');
                                videoPlayer.classList.add('fade-out');

                                setTimeout(function() {
                                    currentVideo++;
                                    if (currentVideo >= videos.length) {
                                        currentVideo = 0; // Loop back to the first video
                                    }
                                    videoSource.src = "{{ asset('storage') }}/" + videos[currentVideo];
                                    videoPlayer.load();

                                    videoPlayer.classList.remove('fade-out');
                                    videoPlayer.classList.add('fade-in');
                                    videoPlayer.play();
                                }, 500); // This should match the transition duration in CSS
                            }

                            videoPlayer.addEventListener('ended', fadeToNextVideo);
                        });
                    </script>
                @else
                    <p>No videos found in this playlist.</p>
                @endif
                </div>
                @if($this->isFeatureActive('layanan'))
                <div class="grid grid-cols-1 w-full mb-3">
                    <div class="space-y-2">
                        <div wire:poll.1500ms="refreshLayanan1">
                            <div class="flex rounded-lg overflow-hidden w-full">
                                <div class="bg-blue-700 text-white py-3 flex-1 flex items-center px-4 text-left">
                                    <span class="font-bold text-2xl">Teller</span>
                                </div>
                                <div class="bg-blue-800 py-3 flex-1 flex items-center justify-center">
                                    <span class="font-bold text-5xl">
                                        {{ $layananAntrian1->nomor_antrian }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div wire:poll.1500ms="refreshLayanan2">
                            <div class="flex rounded-lg overflow-hidden w-full">
                                <div class="bg-blue-700 text-white py-3 flex-1 flex items-center px-4 text-left">
                                    <span class="font-bold text-2xl">Customer Service</span>
                                </div>
                                <div class="bg-blue-800 py-3 flex-1 flex items-center justify-center">
                                    <span class="font-bold text-5xl">
                                        {{ $layananAntrian2->nomor_antrian }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($this->isFeatureActive('loket'))
                <div wire:poll.1500ms="refreshQueue">
                    <div class="grid grid-cols-5 gap-4 text-center">
                        @foreach($loketPelayanan as $loket)
                            <div class="rounded-lg shadow-md overflow-hidden text-center" id="loket-{{ $loket->nama_loket }}">
                                <div class="bg-blue-700 text-white py-2 px-4 font-bold">
                                    {{ $loket->nama_loket }}
                                </div>
                                <div class="py-2 px-2 text-blue-800 bg-white text-4xl text-center font-bold">
                                    {{ $queueData[$loket->nama_loket] ?? '-' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div>
                @if($this->isFeatureActive('valas'))
                    @if($this->isFeatureActive('valas_pusat'))
                        <div wire:poll.3600s="refreshCurrency">
                            <p class="text-lg font-bold">Kurs Valas</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <table class="w-full text-center bg-blue-800 rounded-lg shadow-md overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th class="py-1 px-4 bg-blue-700">Mata Uang</th>
                                            <th class="py-1 px-4 bg-blue-700">Jual</th>
                                            <th class="py-1 px-4 bg-blue-700">Beli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currencyTable1 as $item)
                                        <tr>
                                            <td class="py-1 px-4"><span class="fi fi-{{ strtolower($item['kode_iso_valas']) }}"></span>  {{ $item['kode_valas'] }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['jual'], 0, ',', '.') }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['beli'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="w-full text-center bg-blue-800 rounded-lg shadow-md overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th class="py-1 px-4 bg-blue-700">Mata Uang</th>
                                            <th class="py-1 px-4 bg-blue-700">Jual</th>
                                            <th class="py-1 px-4 bg-blue-700">Beli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currencyTable2 as $item)
                                        <tr>
                                            <td class="py-1 px-4"><span class="fi fi-{{ strtolower($item['kode_iso_valas']) }}"></span>  {{ $item['kode_valas'] }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['jual'], 0, ',', '.') }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['beli'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div wire:poll.600s="refreshValas">
                            <p class="text-lg font-bold">Kurs Valas</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <table class="w-full text-center bg-blue-800 rounded-lg shadow-md overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th class="py-1 px-4 bg-blue-700">Mata Uang</th>
                                            <th class="py-1 px-4 bg-blue-700">Jual</th>
                                            <th class="py-1 px-4 bg-blue-700">Beli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($valasTable1 as $item)
                                        <tr>
                                            <td class="py-1 px-4"><span class="fi fi-{{ strtolower($item['kode_iso_valas']) }}"></span>  {{ $item['kode_valas'] }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['jual'], 0, ',', '.') }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['beli'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="w-full text-center bg-blue-800 rounded-lg shadow-md overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th class="py-1 px-4 bg-blue-700">Mata Uang</th>
                                            <th class="py-1 px-4 bg-blue-700">Jual</th>
                                            <th class="py-1 px-4 bg-blue-700">Beli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($valasTable2 as $item)
                                        <tr>
                                            <td class="py-1 px-4"><span class="fi fi-{{ strtolower($item['kode_iso_valas']) }}"></span>  {{ $item['kode_valas'] }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['jual'], 0, ',', '.') }}</td>
                                            <td class="py-1 px-4">{{ number_format($item['beli'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endif

                @if($this->isFeatureActive('counter_rate'))
                    <div class="grid grid-cols-1 gap-3 mt-1">
                        <div>
                        <p class="text-lg font-bold">Deposito</p>
                            <table class="w-full text-center bg-blue-800 rounded-lg shadow-md overflow-hidden">
                                <thead>
                                    <tr>
                                        <th class="py-1 px-4 bg-blue-700">Tiering</th>
                                        <th class="py-1 px-4 bg-blue-700">1 Bulan</th>
                                        <th class="py-1 px-4 bg-blue-700">3 Bulan</th>
                                        <th class="py-1 px-4 bg-blue-700">6 Bulan</th>
                                        <th class="py-1 px-4 bg-blue-700">12 Bulan</th>
                                        <th class="py-1 px-4 bg-blue-700">24 Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($counterRates as $tiering => $rates)
                                    <tr>
                                        <td class="py-1 px-4">{{ $tiering }}</td>
                                        @foreach ([1, 3, 6, 12, 24] as $duration)
                                            @php
                                                $rate = $rates->firstWhere('duration', $duration);
                                            @endphp
                                            <td class="py-1 px-4">{{ $rate ? $rate->rate . '%' : '-' }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-1">
                    @if($this->isFeatureActive('lps'))
                    <div>
                    <p class="text-lg font-bold">LPS</p>
                        <table class="w-full text-center bg-blue-800 rounded-lg shadow-md overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="py-1 px-4 bg-blue-700">Bunga Penjaminan LPS</th>
                                    <th class="py-1 px-4 bg-blue-700">Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lps as $item)
                                <tr>
                                    <td class="py-1 px-4">{{ $item->nama_rate }}</td>
                                    <td class="py-1 px-4">{{ $item->rate }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <div>
                    @if($this->isFeatureActive('iklan'))
                        <div class="relative overflow-hidden h-40 rounded-md mt-2" wire:ignore style="width: 310px;">
                            <div id="carousel" class="flex transition-transform duration-500 ease-in-out h-full">
                                @foreach($images as $index => $image)
                                    <div class="carousel-item w-72 h-40 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $image->url) }}" class="w-full h-full object-cover carousel-slide" alt="iklan {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- last update text -->
                        <div class="text-right mt-1">
                            <p class="text-xs">Terakhir diperbarui: {{ $lastUpdate }} WIB</p>
                        </div>
                    @endif
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            function initializeCarousel() {
                                var carousel = document.getElementById('carousel');
                                var carouselItems = carousel.querySelectorAll('.carousel-item');
                                var currentSlide = 0;

                                function nextSlide() {
                                    currentSlide++;
                                    if (currentSlide >= carouselItems.length) {
                                        currentSlide = 0;
                                    }
                                    carousel.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
                                }

                                setInterval(nextSlide, 5000);
                            }

                            initializeCarousel();

                            window.addEventListener('carousel-updated', function () {
                                initializeCarousel();
                            });
                        });
                    </script>
                    </div>

                </div> 
            </div>
        </div>
    </div>
    <footer class="uk-section uk-padding-remove-vertical fixed bottom-0 left-0 right-0">
        <!-- grid for small clock at right -->
        <div class="grid grid-cols-12">
            <div class="col-span-11" wire:poll.10s="refreshPesan">
                <marquee class="pt-1 text-xl font-bold">{{ $pesan }}</marquee>
            </div>
            <div>
                <!-- clock -->
                <div class="text-right pr-4 mb-0">
                    <p class="text-3xl font-bold">{{ $time }}</p>
                </div>
            </div>
        </div>

        <div class="is-footerbar uk-container-expand">
            <div class="is-footerbar-area is-footerbar-start"></div>
            <div class="is-footerbar-area is-footerbar-middle"></div>
            <div class="is-footerbar-area is-footerbar-end"></div>
        </div>
    </footer>

</div>