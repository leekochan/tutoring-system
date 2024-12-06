<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Additional CSS for fixed positioning -->
    <style>
        .fixed-navigation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .fixed-header {
            position: fixed;
            top: 64px; /* Adjust based on your navigation bar height */
            left: 0;
            width: 100%;
            z-index: 999;
        }
        .content-wrapper {
            padding-top: 130px; /* Adjust to account for fixed nav and header */
        }
        html {
            overflow-y: scroll;
            scrollbar-gutter: stable both-edges;
            margin: 0;
            padding: 0;
        }

        body {
            width: 100%;
            min-width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            overscroll-behavior-x: none;
        }

        .min-h-screen {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex-grow: 1;
            width: 100%;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <div class="fixed-navigation">
            @include('layouts.navigation')
        </div>

        <!-- Page Heading -->
        @isset($header)
            <div class="fixed-header bg-white shadow">
                <div class="max-w-7xl max-h-64 mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <!-- Page Content -->
        <main class="content-wrapper">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
