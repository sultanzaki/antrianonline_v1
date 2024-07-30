<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Antrian Online Bank BJB</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

    </head>
    <style>
        body, html {
        height: 100%;
        margin: 0;
        font-family: 'Inter', sans-serif;
        background-image: url("{{ asset('assets/images/bg.jpg') }}");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        }
    </style>
    <body class="antialiased">
        @livewire('touchsreen-antrian')
    </body>
</html>
