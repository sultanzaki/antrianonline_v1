<div class="flex flex-col min-h-screen">
    <main class="flex-grow px-4 py-8 justify-center items-center">
        <div class="container mx-auto text-center max-w-4xl">
            <!-- Logo and Welcome Text Container -->
            <div class="bg-blue-800 rounded-2xl p-8 mb-12 shadow-lg">
                <!-- Logo -->
                <div class="mb-8 transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('assets/images/logo.png') }}" class="mx-auto" alt="logo" width="200" height="200">
                </div>

                <!-- Welcome Text -->
                <div>
                    <p class="text-white font-semibold text-xl md:text-2xl lg:text-3xl animate-fade-in-up">
                        Bank BJB KCP Kadipaten
                    </p>
                </div>
            </div>

            <!-- Service Buttons -->
            <div class="space-y-6">
            @foreach ($layanan as $item)
                    <button 
                        wire:click="generateNomorAntrian({{ $item->id_pelayanan }})" 
                        class="shadow-lg group relative w-full h-36 rounded-full font-bold text-blue-800 bg-white text-3xl md:text-4xl lg:text-5xl transform transition-all duration-300 ease-in-out hover:bg-blue-50 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 active:scale-95"
                    >
                        <div class="absolute top-1/2 left-4 transform -translate-y-1/2 flex items-center justify-center w-28 h-28 bg-blue-800 rounded-full text-white text-center transition-all duration-300 group-hover:bg-blue-700 group-hover:scale-110">
                            {{ $item->kode_pelayanan }}
                        </div>
                        <span class="ml-12">{{ $item->nama_pelayanan }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </main>

    <footer class="w-full">
        <div class="grid grid-cols-3">
            <div class="h-2 bg-[#0b79ca]"></div>
            <div class="h-2 bg-[#0078ff]"></div>
            <div class="h-2 bg-[#edc817]"></div>
        </div>
    </footer>
</div>