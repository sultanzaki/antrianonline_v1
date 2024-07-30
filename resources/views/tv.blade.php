<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Antrian Online Bank BJB</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"
            />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
            #videoPlayer {
                transition: opacity 0.5s ease-in-out;
            }
            .fade-out {
                opacity: 0;
            }
            .fade-in {
                opacity: 1;
            }
            .carousel {
                display: flex;
                overflow: hidden;
                transition: transform 0.5s ease-in-out;
            }
            .carousel-item {
                flex: 0 0 100%;
            }
            .carousel-slide {
                object-position: center;
            }
            .uk-padding-remove-vertical {
                padding-bottom: 0 !important;
                padding-top: 0 !important;
            }

            @media (min-width: 960px) {
                .uk-section {
                    padding-bottom: 70px;
                    padding-top: 70px;
                }
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

            .footer-text {
                text-align: center;
                color: white;
                font-size: 1.25rem;
                font-weight: bold;
            }
            @keyframes blink {
                0% { background-color: transparent; }
                50% { background-color: yellow; }
                100% { background-color: transparent; }
            }

            .blinking {
                animation: blink 1s ease-in-out;
            }


        </style>


    </head>
    <body class="antialiased bg-blue-900 text-white">
        @livewire('t-v-antrian', ['playlistId' => 1])

        @livewireScripts
    </body>
</html>
