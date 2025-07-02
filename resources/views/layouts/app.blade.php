<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PediYÁ') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navBar.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/users/perfilUsuario.css') }}">
        <link rel="stylesheet" href="{{ asset('css/users/principalUsuario.css') }}">
        <link rel="stylesheet" href="{{ asset('css/users/detallesTienda.css') }}">
        <link rel="stylesheet" href="{{ asset('css/users/detallesPedidos.css') }}"> 
        <link rel="stylesheet" href="{{ asset('css/users/historialPedidos.css') }}"> --}}
        @yield('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="cont-all-app">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    {{-- <script src="{{ asset('js/homeCliente.js') }}"></script>
    
    <script src="{{ asset('js/perfilUsuario.js') }}"></script> --}}
    <script src="{{ asset('js/notificaciones.js') }}"></script>

    @yield('scripts')
    </body>
</html>
