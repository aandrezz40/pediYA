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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>







<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PediYÁ </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <header>
                <section class="bar-logo">
                    {{-- Aquí usaremos la helper asset() para las imágenes --}}
                    <img id="icono-nav-bar" class="icono-hamburguesa" src="{{ asset('sources/img/icono-hamburguesa.png') }}" alt="">
                    <h1 class="nombreEmpresa">PediYÁ</h1>
                </section>

                <section class="bar-search">
                    <img class="icono-search" src="{{ asset('sources/img/search_.png') }}" alt="">
                    <input class="input-search" type="text" placeholder="Tiendas, productos...">
                </section>
                <section class="bar-buttons">
                    {{-- Los enlaces deberías cambiarlos por rutas de Laravel --}}
                    <a class="button-ingreso" href="{{ route('login') }}">Ingreso</a> {{-- Ejemplo: enlace a login --}}
                    <img class="icono-carrito-view" src="{{ asset('sources/img/shopping-cart_.png') }}" alt="" id="abrirCarrito">
                </section>
            </header>

            <aside id="cont-nav-bar">
                <section class="nav-bar">
                    <div class=""><img class="icono-nav cerrar-nav" src="{{ asset('sources/img/x-fill-12_.png') }}" alt="" id="close-nav-bar"></div>
                    <div class="cont-icono">
                         {{-- Los SVG se pueden mantener directamente --}}
                        <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="home">
                        <path d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"></path>
                        </svg>
                        <article class="container-links">
                            {{-- Los enlaces deberían usar rutas de Laravel --}}
                            <h3><a href="{{ route('dashboard') }}" class="link">Pagina principal</a></h3> {{-- Ejemplo: enlace al dashboard --}}
                        </article>
                    </div>
                     {{-- Repite para los otros cont-icono con SVG y enlaces --}}
                    <div class="cont-icono">
                         <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="service">
                            <path fill-rule="evenodd" d="M327.338,318.25c-.179,1.483-.467,2.969-.869,4.451l-.009-.003c-.075.273-.221.744-.435,1.409-1.672,5.194-4.571,9.705-8.304,13.355,11.417,1.464,24.516-.03,41.815-8.101l66.211-35.345c-.275-1.192-.779-2.373-1.525-3.496-1.739-2.616-4.445-4.225-7.541-4.912-3.926-.872-8.475-.348-12.784,1.411l-.013-.032-76.545,31.262h0ZM116.297,307.805l64.043-32.242c2.863-1.441,5.769-2.295,8.7-2.575,2.963-.283,6.089.025,9.354.912l98.6,26.761c.641.174.743.191.832.219,4.025,1.296,7.164,3.855,9.014,7.003,1.727,2.939,2.313,6.439,1.382,9.869v.037l-.149.556c-1.203,3.736-4.071,6.72-7.723,8.543-3.799,1.896-8.356,2.52-12.805,1.472-.272-.086-.546-.159-.821-.219l-50.239-13.189c-5.039-1.326-10.198,1.684-11.524,6.722-1.326,5.039,1.684,10.198,6.722,11.524l50.118,13.157c2.418.891,3.307,1.225,4.203,1.562,22.305,8.39,43.454,16.345,81.716-1.588l.443-.222,70.83-37.811c.407-.182.8-.392,1.177-.628l16.201-8.649c3.373-1.8,7.28-2.161,10.858-1.292,3.429.833,6.472,2.793,8.298,5.676l.21.328c1.464,2.491,1.711,5.274.954,7.842-.837,2.841-2.862,5.484-5.833,7.365l-.474.299-146.036,85.82c-3.083,1.811-6.359,2.924-9.742,3.327-3.398.405-6.913.088-10.46-.959l-41.964-12.395c-1.084-.32-1.638-.496-4.165-1.254-20.288-6.084-32.885-9.861-53.385,1.818l-26.24,14.949-62.095-102.741h0ZM113.81,489.291L17.371,329.727c-2.693-4.467-1.254-10.272,3.213-12.965l65.996-39.887c4.467-2.693,10.272-1.254,12.965,3.213l6.965,11.523,65.335-32.892c4.961-2.498,10.114-3.989,15.422-4.496,5.344-.51,10.714-.027,16.077,1.429l98.6,26.761c.195.053.741.224,1.645.515,8.58,2.762,15.378,8.405,19.504,15.424.205.349.403.701.595,1.056l73.116-29.862v-.037c7.719-3.152,16.232-4.009,23.939-2.298,7.709,1.712,14.58,5.923,19.213,12.891,1.054,1.584,1.933,3.229,2.644,4.915l4.906-2.619c7.605-4.059,16.29-4.903,24.155-2.991,8.013,1.947,15.265,6.754,19.822,13.95.087.138.253.415.506.845,4.254,7.239,4.982,15.288,2.801,22.691-2.1,7.128-6.926,13.597-13.885,18.003-.18.114-.506.31-.991.595l-146.036,85.82c-5.417,3.183-11.152,5.135-17.055,5.838-5.888.702-11.936.166-17.995-1.624l-46.203-13.649c-15.552-4.663-25.208-7.559-38.684.119l-25.791,14.693,7.835,12.962c2.693,4.467,1.254,10.272-3.213,12.965l-65.996,39.887c-4.467,2.693-10.272,1.254-12.965-3.213h0ZM38.429,328.049l86.668,143.397,49.829-30.116-86.667-143.397-49.83,30.116h0ZM342.539,37.05h-23.136l-5.232,16.318-.008-.003c-.944,2.93-3.302,5.339-6.493,6.208-3.555.97-7.066,2.177-10.513,3.606-3.305,1.37-6.615,3.004-9.91,4.888l-.007-.012c-2.681,1.53-6.058,1.716-9.006.197l-15.235-7.837-16.35,16.349,7.593,14.76c1.662,2.826,1.804,6.439.06,9.488-1.884,3.296-3.52,6.608-4.89,9.914-1.376,3.32-2.546,6.699-3.497,10.12-.715,3.141-3.023,5.834-6.313,6.89l-16.318,5.232v23.136l16.318,5.232-.003.008c2.93.944,5.339,3.302,6.208,6.493.97,3.555,2.177,7.066,3.605,10.513,1.369,3.305,3.005,6.615,4.889,9.911l-.012.007c1.53,2.681,1.716,6.058.197,9.006l-7.838,15.235,16.35,16.35,14.76-7.593c2.826-1.662,6.438-1.804,9.488-.06,3.296,1.884,6.608,3.52,9.915,4.89,3.32,1.375,6.699,2.546,10.12,3.497,3.141.715,5.834,3.023,6.89,6.313l5.232,16.318h23.136l5.232-16.318.008.003c.944-2.93,3.302-5.339,6.493-6.208,3.555-.97,7.065-2.177,10.513-3.605,3.305-1.37,6.616-3.005,9.911-4.889l.007.012c2.681-1.53,6.058-1.716,9.006-.197l15.235,7.837,16.349-16.349-7.593-14.76c-1.662-2.826-1.804-6.438-.06-9.488,1.884-3.296,3.52-6.608,4.89-9.914,1.376-3.321,2.546-6.7,3.497-10.12.716-3.141,3.023-5.834,6.313-6.89l16.318-5.232v-23.136l-16.318-5.232.003-.008c-2.93-.944-5.339-3.302-6.208-6.493-.97-3.555-2.178-7.066-3.606-10.513-1.369-3.305-3.005-6.616-4.889-9.911l.012-.007c-1.53-2.681-1.716-6.058-.197-9.006l7.837-15.235-16.349-16.349-14.76,7.593c-2.826,1.662-6.438,1.804-9.488.06-3.1