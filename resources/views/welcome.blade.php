<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Antrian Online Bank BJB</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        @keyframes wave {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        .wave-bg {
            background-image: url("{{ asset('assets/images/bg.png') }}");
            animation: wave 15s linear infinite;
        }
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.7) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                transparent 100%
            );
            transform: rotate(45deg);
            transition: all 0.5s;
        }
        .btn-shine:hover::before {
            transform: rotate(45deg) translateY(100%);
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-blue-100 to-blue-200 min-h-screen">
    <div x-data="{ showContent: false }" x-init="setTimeout(() => showContent = true, 500)" class="flex flex-col min-h-screen">
        <div class="wave-bg absolute inset-0 opacity-10"></div>
        
        <main class="flex-grow flex items-center justify-center px-4 py-12 relative">
            <div 
                x-show="showContent"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="container mx-auto text-center max-w-2xl"
            >
                <div class="bg-white bg-opacity-80 backdrop-blur-md rounded-3xl p-8 mb-12 shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('assets/images/logo_warna.png') }}" class="mx-auto" alt="logo" width="200">
                </div>

                <div class="space-y-6">
                    <a href="/login" class="btn-shine w-full py-5 bg-blue-600 text-white text-2xl font-bold rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1 hover:scale-105 inline-flex items-center justify-center">
                        <svg class="w-8 h-8 mr-3 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </main>

        <footer class="w-full">
            <div class="grid grid-cols-3">
                <div class="h-3 bg-blue-400"></div>
                <div class="h-3 bg-blue-600"></div>
                <div class="h-3 bg-yellow-400"></div>
            </div>
        </footer>
    </div>
</body>
</html>