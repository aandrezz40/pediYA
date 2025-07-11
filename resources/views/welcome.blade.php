<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PediYÁ </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header>
        <section class="bar-logo">
            <img id="icono-nav-bar"class="icono-hamburguesa" src="{{ asset('img/icono-hamburguesa.png') }}" alt="">
            <a href="{{ url('/') }}">
                <h1 class="nombreEmpresa">PediYÁ</h1>
            </a>
        </section>
        
        <form class="form-bar-search" action="{{ route('busquedaTienda') }}" method="post">
        @csrf    
            <section class="bar-search">
                <img class="icono-search" src="{{ asset('img/search_.png') }}" alt="">
                <input class="input-search" name="nameStore" type="text" placeholder="Tiendas...">
                <input class="btn-search" type="submit" value="Buscar">
            </section>
        </form>
        <section class="bar-buttons">
            <a class="button-ingreso" href="{{ route('login') }}">Ingreso</a>
        </section>
    </header>
    <aside id="cont-nav-bar">
        <section class="nav-bar">
                <div class=""><img class="icono-nav cerrar-nav" src="{{ asset('img/x-fill-12_.png') }}" alt="" id="close-nav-bar"></div>
            
            <div class="cont-icono">
                <a href="{{ url('/home') }}">
                    <svg  class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="home">
                    <path d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"></path>
                    </svg>
                </a>
                <article class="container-links">
                    <h3>Panel principal</h3>
                </article>
            </div>
            <div class="cont-icono">
                <a href="{{ url('/nosotros') }}">
                    <svg class="icono-nav"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="envelope">
                    <g>
                        <path d="M28.88,25.75H3.13a1.88,1.88,0,0,1-1.87-1.87V8.13A1.88,1.88,0,0,1,3.13,6.25H28.88a1.88,1.88,0,0,1,1.88,1.88V23.88A1.88,1.88,0,0,1,28.88,25.75ZM3.13,7.75a.38.38,0,0,0-.37.38V23.88a.38.38,0,0,0,.38.38H28.88a.38.38,0,0,0,.38-.37V8.13a.38.38,0,0,0-.37-.37Z"></path>
                        <rect width="10" height="1.5" x="6" y="17" rx=".75" ry=".75"></rect>
                        <rect width="5" height="1.5" x="6" y="13.5" rx=".75" ry=".75"></rect>
                        <path d="M25.45,19.5H21a1.3,1.3,0,0,1-1.3-1.3V13.8A1.3,1.3,0,0,1,21,12.5h4.4a1.3,1.3,0,0,1,1.3,1.3v4.4A1.3,1.3,0,0,1,25.45,19.5ZM21.25,18h4V14h-4Z"></path>
                    </g>
                    </svg>
                </a>
                
                <article class="container-links">
                    <h3>Sobre Nosotros</h3>
                </article>
            </div>
            <div class="cont-icono">
                <a href="{{ url('/contacto') }}">
                    <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" width="32" height="32" id="contacts">
                        <path d="M26 0H2a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 2h4v28H2V2zm24 28H8V2h18v28zM13.862 10.734a3.028 3.028 1080 1 0 6.056 0 3.028 3.028 1080 1 0-6.056 0zm3.09 4.238c-2.734 0-4.952 2.974-4.952 6.642s9.906 3.668 9.906 0-2.218-6.642-4.954-6.642zM30 2h2v6h-2zm0 8h2v6h-2zm0 8h2v6h-2z"></path>
                    </svg>
                </a>
                <article class="container-links">
                    <h3>Contacto</h3>
                </article>
            </div>
        </section>
    </aside>
    <main>
        <section class="banner">
            <article class="cont-slogan">
                <!-- <img src="{{ asset('img/Rectángulo.png') }}" alt="" class="logo-principal"> -->
                <h2 class="titulo">PediYÁ</h2>
                <p>Compra fácil, recoge rápido. PediYÁ...</p>
                <button type="submit" class="button-action"><a href="{{ route('home') }}">¡Pide YÁ!</a></button>
            </article>
            <article class="cont-slider">
                <h2>¡BIENVENIDOS!</h2>
                <section class="container-slider">
                    <section class="buttons-slider">
                        <button type="submit" class="button-slider-advance" onclick="nextSlide()">></button>
                        <button type="submit" class="button-slider-back" onclick="prevSlide()"><</button>
                    </section>
                    <section class="carousel">
                        <section class="cont-img">
                            <article class="slide active "><img src="{{ asset('img/slider-1.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-2.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-3.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-4.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-5.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-1.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-2.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-3.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-4.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-5.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-1.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-2.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-3.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-4.jpg') }}" alt=""></article>
                            <article class="slide blurred"><img src="{{ asset('img/slider-5.jpg') }}" alt=""></article>
                        </section>
                    </section>
                </section>
                <a href="{{ url('/') }}">
                    <button class="button-action" type="submit"><a href="{{ route('home') }}">¡Únete YÁ!</a></button>
                </a>
            </article>
        </section>

        <!-- ESTRUCTURA DEL BENTOR -->
        <section class="bentor-container">
            <article class="bentor">
                <section  class="card-bentor bentor-left-top">
                    <article>
                        <img src="{{ asset('img/logo-v1.png') }}" alt="Bentor">
                    </article>
                    <article>
                        <h2>Accede a todas las tiendas de barrio en un solo lugar</h2>
                    </article>
                    <article>
                        <p>Explora y realiza pedidos fácilmente desde múltiples tiendas cercanas.</p>
                    </article>
                </section>
    
                <section class="card-bentor bentor-medium-top">
                    <article>
                        <h2>Estima tus ventas</h2>
                    </article>
                    <article>
                        <p>Analiza la demanda y las tendencias de comprar antes de tomar decisiones de inventario</p>
                    </article>
                </section>
    
                <section class="card-bentor bentor-rigth-top">
                    <article>
                        <h2>Encuentra dónde destacan tus productos</h2>
                    </article>
                    <article>
                        <p>Identifica qué productos son los más solicitados y optimiza tu stock.</p>
                    </article>
                </section>
    
                <section class="card-bentor bentor-medium">
                    <h2>PediYÁ</h2>
                </section>
    
                <section class="card-bentor bentor-left-bottom">
                    <article>
                        <h2>Mantente por delante de la competencia</h2>
                    </article>
                    <article>
                        <p>Monitorea las tendencias de compra en tiempo real y ajusta tu oferta según la demanda.</p>
                    </article>
                </section>
    
                <section class="card-bentor bentor-rigth-bottom">
                    <article>
                        <h2>Predice tus ganancias con precisión</h2>
                    </article>
                    <article>
                        <p>Calcula tus márgenes de ganancia con anticipación y optimiza tus precios para mayor rentabilidad.</p>
                    </article>
                </section>
    
            </article>
        </section>
        
    </main>
    <footer>
        <section class="cont-nombre-footer">
            <h2>PediYÁ</h2>
            <p>Compra fácil, recoge rápido. PediYÁ...</p>
        </section>
        <section class="cont-iconos-footer">
            <article class="cont-links-footer">
                <section class="cont-icono-footer">
                    <a href="">
                        <svg  class="icono-footer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="home">
                            <path d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"></path>
                        </svg>
                    </a>
                    
                    <h3>INICIO</h3>
                </section>
                <section class="cont-icono-footer">
                    <a href="">
                        <svg class="icono-footer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="service">
                            <path fill-rule="evenodd" d="M327.338,318.25c-.179,1.483-.467,2.969-.869,4.451l-.009-.003c-.075.273-.221.744-.435,1.409-1.672,5.194-4.571,9.705-8.304,13.355,11.417,1.464,24.516-.03,41.815-8.101l66.211-35.345c-.275-1.192-.779-2.373-1.525-3.496-1.739-2.616-4.445-4.225-7.541-4.912-3.926-.872-8.475-.348-12.784,1.411l-.013-.032-76.545,31.262h0ZM116.297,307.805l64.043-32.242c2.863-1.441,5.769-2.295,8.7-2.575,2.963-.283,6.089.025,9.354.912l98.6,26.761c.641.174.743.191.832.219,4.025,1.296,7.164,3.855,9.014,7.003,1.727,2.939,2.313,6.439,1.382,9.869v.037l-.149.556c-1.203,3.736-4.071,6.72-7.723,8.543-3.799,1.896-8.356,2.52-12.805,1.472-.272-.086-.546-.159-.821-.219l-50.239-13.189c-5.039-1.326-10.198,1.684-11.524,6.722-1.326,5.039,1.684,10.198,6.722,11.524l50.118,13.157c2.418.891,3.307,1.225,4.203,1.562,22.305,8.39,43.454,16.345,81.716-1.588l.443-.222,70.83-37.811c.407-.182.8-.392,1.177-.628l16.201-8.649c3.373-1.8,7.28-2.161,10.858-1.292,3.429.833,6.472,2.793,8.298,5.676l.21.328c1.464,2.491,1.711,5.274.954,7.842-.837,2.841-2.862,5.484-5.833,7.365l-.474.299-146.036,85.82c-3.083,1.811-6.359,2.924-9.742,3.327-3.398.405-6.913.088-10.46-.959l-41.964-12.395c-1.084-.32-1.638-.496-4.165-1.254-20.288-6.084-32.885-9.861-53.385,1.818l-26.24,14.949-62.095-102.741h0ZM113.81,489.291L17.371,329.727c-2.693-4.467-1.254-10.272,3.213-12.965l65.996-39.887c4.467-2.693,10.272-1.254,12.965,3.213l6.965,11.523,65.335-32.892c4.961-2.498,10.114-3.989,15.422-4.496,5.344-.51,10.714-.027,16.077,1.429l98.6,26.761c.195.053.741.224,1.645.515,8.58,2.762,15.378,8.405,19.504,15.424.205.349.403.701.595,1.056l73.116-29.862v-.037c7.719-3.152,16.232-4.009,23.939-2.298,7.709,1.712,14.58,5.923,19.213,12.891,1.054,1.584,1.933,3.229,2.644,4.915l4.906-2.619c7.605-4.059,16.29-4.903,24.155-2.991,8.013,1.947,15.265,6.754,19.822,13.95.087.138.253.415.506.845,4.254,7.239,4.982,15.288,2.801,22.691-2.1,7.128-6.926,13.597-13.885,18.003-.18.114-.506.31-.991.595l-146.036,85.82c-5.417,3.183-11.152,5.135-17.055,5.838-5.888.702-11.936.166-17.995-1.624l-46.203-13.649c-15.552-4.663-25.208-7.559-38.684.119l-25.791,14.693,7.835,12.962c2.693,4.467,1.254,10.272-3.213,12.965l-65.996,39.887c-4.467,2.693-10.272,1.254-12.965-3.213h0ZM38.429,328.049l86.668,143.397,49.829-30.116-86.667-143.397-49.83,30.116h0ZM342.539,37.05h-23.136l-5.232,16.318-.008-.003c-.944,2.93-3.302,5.339-6.493,6.208-3.555.97-7.066,2.177-10.513,3.606-3.305,1.37-6.615,3.004-9.91,4.888l-.007-.012c-2.681,1.53-6.058,1.716-9.006.197l-15.235-7.837-16.35,16.349,7.593,14.76c1.662,2.826,1.804,6.439.06,9.488-1.884,3.296-3.52,6.608-4.89,9.914-1.376,3.32-2.546,6.699-3.497,10.12-.715,3.141-3.023,5.834-6.313,6.89l-16.318,5.232v23.136l16.318,5.232-.003.008c2.93.944,5.339,3.302,6.208,6.493.97,3.555,2.177,7.066,3.605,10.513,1.369,3.305,3.005,6.615,4.889,9.911l-.012.007c1.53,2.681,1.716,6.058.197,9.006l-7.838,15.235,16.35,16.35,14.76-7.593c2.826-1.662,6.438-1.804,9.488-.06,3.296,1.884,6.608,3.52,9.915,4.89,3.32,1.375,6.699,2.546,10.12,3.497,3.141.715,5.834,3.023,6.89,6.313l5.232,16.318h23.136l5.232-16.318.008.003c.944-2.93,3.302-5.339,6.493-6.208,3.555-.97,7.065-2.177,10.513-3.605,3.305-1.37,6.616-3.005,9.911-4.889l.007.012c2.681-1.53,6.058-1.716,9.006-.197l15.235,7.837,16.349-16.349-7.593-14.76c-1.662-2.826-1.804-6.438-.06-9.488,1.884-3.296,3.52-6.608,4.89-9.914,1.376-3.321,2.546-6.7,3.497-10.12.716-3.141,3.023-5.834,6.313-6.89l16.318-5.232v-23.136l-16.318-5.232.003-.008c-2.93-.944-5.339-3.302-6.208-6.493-.97-3.555-2.178-7.066-3.606-10.513-1.369-3.305-3.005-6.616-4.889-9.911l.012-.007c-1.53-2.681-1.716-6.058-.197-9.006l7.837-15.235-16.349-16.349-14.76,7.593c-2.826,1.662-6.438,1.804-9.488.06-3.154-1.803-6.322-3.378-9.486-4.711-.156-.056-.312-.115-.466-.179-3.364-1.394-6.731-2.565-10.084-3.497-3.14-.716-5.833-3.024-6.889-6.312l-5.232-16.318h0ZM312.536,18.138v.028c-3.987-.001-7.692,2.547-8.976,6.547l-5.828,18.178c-2.644.859-5.225,1.812-7.74,2.855-2.607,1.08-5.124,2.234-7.545,3.459l-16.367-8.42c-3.638-2.211-8.446-1.745-11.591,1.399l-26.072,26.071.014.014c-2.824,2.823-3.641,7.253-1.713,10.993l8.72,16.95c-1.225,2.423-2.38,4.941-3.46,7.549-1.041,2.514-1.994,5.094-2.853,7.737l-17.442,5.592c-4.189.972-7.31,4.727-7.31,9.211v36.871h.028c0,3.987,2.547,7.692,6.547,8.976l18.178,5.828c.859,2.644,1.812,5.225,2.854,7.74,1.08,2.607,2.235,5.124,3.459,7.546l-8.42,16.367c-2.211,3.638-1.745,8.446,1.399,11.591l26.072,26.072.014-.014c2.823,2.824,7.253,3.641,10.993,1.713l16.951-8.72c2.423,1.225,4.941,2.38,7.549,3.461,2.513,1.041,5.094,1.994,7.736,2.853l5.592,17.442c.972,4.189,4.727,7.31,9.211,7.31h36.871v-.028c3.987.001,7.692-2.547,8.976-6.547l5.828-18.178c2.644-.859,5.225-1.812,7.74-2.854,2.607-1.08,5.124-2.235,7.546-3.459l16.367,8.42c3.638,2.211,8.446,1.745,11.591-1.399l26.071-26.071-.014-.014c2.824-2.823,3.641-7.253,1.713-10.993l-8.72-16.951c1.225-2.423,2.38-4.94,3.46-7.549,1.042-2.514,1.994-5.094,2.853-7.737l17.442-5.592c4.189-.972,7.31-4.727,7.31-9.211v-36.871h-.028c0-3.987-2.547-7.691-6.547-8.976l-18.178-5.828c-.86-2.644-1.812-5.225-2.854-7.74-1.08-2.607-2.235-5.124-3.459-7.546l8.42-16.367c2.211-3.638,1.745-8.446-1.399-11.591l-26.071-26.071-.014.014c-2.823-2.824-7.253-3.641-10.993-1.713l-16.951,8.72c-2.261-1.143-4.604-2.225-7.027-3.243-.159-.077-.32-.15-.485-.218-2.502-1.037-5.096-1.991-7.775-2.858l-5.59-17.437c-.972-4.189-4.727-7.31-9.211-7.31h-36.871ZM358.225,117.483c6.974,6.974,11.288,16.61,11.288,27.254s-4.314,20.28-11.288,27.254c-6.974,6.974-16.61,11.288-27.254,11.288s-20.28-4.314-27.254-11.288c-6.974-6.974-11.288-16.61-11.288-27.254s4.314-20.28,11.288-27.254c6.974-6.974,16.61-11.288,27.254-11.288s20.28,4.314,27.254,11.288h0ZM330.971,87.283c15.864,0,30.227,6.431,40.625,16.829,10.397,10.398,16.829,24.761,16.829,40.625s-6.431,30.228-16.829,40.625c-10.398,10.398-24.761,16.829-40.625,16.829s-30.227-6.431-40.625-16.829c-10.397-10.397-16.829-24.761-16.829-40.625s6.431-30.227,16.829-40.625c10.398-10.397,24.761-16.829,40.625-16.829Z"></path>
                        </svg>
                    </a>

                    <h3>SERVICIOS</h3>
                </section>
                <section class="cont-icono-footer">
                    <a href="">
                        <svg class="icono-footer"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="envelope">
                            <g>
                                <path d="M28.88,25.75H3.13a1.88,1.88,0,0,1-1.87-1.87V8.13A1.88,1.88,0,0,1,3.13,6.25H28.88a1.88,1.88,0,0,1,1.88,1.88V23.88A1.88,1.88,0,0,1,28.88,25.75ZM3.13,7.75a.38.38,0,0,0-.37.38V23.88a.38.38,0,0,0,.38.38H28.88a.38.38,0,0,0,.38-.37V8.13a.38.38,0,0,0-.37-.37Z"></path>
                                <rect width="10" height="1.5" x="6" y="17" rx=".75" ry=".75"></rect>
                                <rect width="5" height="1.5" x="6" y="13.5" rx=".75" ry=".75"></rect>
                                <path d="M25.45,19.5H21a1.3,1.3,0,0,1-1.3-1.3V13.8A1.3,1.3,0,0,1,21,12.5h4.4a1.3,1.3,0,0,1,1.3,1.3v4.4A1.3,1.3,0,0,1,25.45,19.5ZM21.25,18h4V14h-4Z"></path>
                            </g>
                        </svg>
                    </a>
                    
                    <h3>NOSOTROS</h3>
                </section>
                <section class="cont-icono-footer">
                    <a href="">
                        <svg class="icono-footer" xmlns="http://www.w3.org/2000/svg" width="32" height="32" id="contacts">
                            <path d="M26 0H2a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 2h4v28H2V2zm24 28H8V2h18v28zM13.862 10.734a3.028 3.028 1080 1 0 6.056 0 3.028 3.028 1080 1 0-6.056 0zm3.09 4.238c-2.734 0-4.952 2.974-4.952 6.642s9.906 3.668 9.906 0-2.218-6.642-4.954-6.642zM30 2h2v6h-2zm0 8h2v6h-2zm0 8h2v6h-2z"></path>
                        </svg>
                    </a>
                    
                    <h3>CONTACTANOS</h3>
                </section>
            </article>
            <article class="cont-iconos-redes">
                <section>
                    <a href="">
                        <svg class="icono-redes" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" id="facebook">
                            <path d="M16 0C7.164 0 0 7.164 0 16s7.164 16 16 16 16-7.164 16-16c0-8.838-7.164-16-16-16zm4.136 15.998L17.514 16l-.002 9.6h-3.598V16h-2.4v-3.308l2.4-.002-.004-1.948c0-2.7.732-4.342 3.91-4.342h2.648v3.31h-1.656c-1.238 0-1.298.462-1.298 1.324l-.004 1.656h2.976l-.35 3.308z"></path>
                          </svg>
                    </a>
                </section>
                <section >
                    <a href="">
                        <svg class="icono-redes" xmlns="http://www.w3.org/2000/svg" width="2500" height="2500" viewBox="0 0 2476 2476" id="instagram">
                            <path d="M825.4 1238c0-227.9 184.7-412.7 412.6-412.7 227.9 0 412.7 184.8 412.7 412.7 0 227.9-184.8 412.7-412.7 412.7-227.9 0-412.6-184.8-412.6-412.7m-223.1 0c0 351.1 284.6 635.7 635.7 635.7s635.7-284.6 635.7-635.7-284.6-635.7-635.7-635.7S602.3 886.9 602.3 1238m1148-660.9c0 82 66.5 148.6 148.6 148.6 82 0 148.6-66.6 148.6-148.6s-66.5-148.5-148.6-148.5-148.6 66.5-148.6 148.5M737.8 2245.7c-120.7-5.5-186.3-25.6-229.9-42.6-57.8-22.5-99-49.3-142.4-92.6-43.3-43.3-70.2-84.5-92.6-142.3-17-43.6-37.1-109.2-42.6-229.9-6-130.5-7.2-169.7-7.2-500.3s1.3-369.7 7.2-500.3c5.5-120.7 25.7-186.2 42.6-229.9 22.5-57.8 49.3-99 92.6-142.4 43.3-43.3 84.5-70.2 142.4-92.6 43.6-17 109.2-37.1 229.9-42.6 130.5-6 169.7-7.2 500.2-7.2 330.6 0 369.7 1.3 500.3 7.2 120.7 5.5 186.2 25.7 229.9 42.6 57.8 22.4 99 49.3 142.4 92.6 43.3 43.3 70.1 84.6 92.6 142.4 17 43.6 37.1 109.2 42.6 229.9 6 130.6 7.2 169.7 7.2 500.3 0 330.5-1.2 369.7-7.2 500.3-5.5 120.7-25.7 186.3-42.6 229.9-22.5 57.8-49.3 99-92.6 142.3-43.3 43.3-84.6 70.1-142.4 92.6-43.6 17-109.2 37.1-229.9 42.6-130.5 6-169.7 7.2-500.3 7.2-330.5 0-369.7-1.2-500.2-7.2M727.6 7.5c-131.8 6-221.8 26.9-300.5 57.5-81.4 31.6-150.4 74-219.3 142.8C139 276.6 96.6 345.6 65 427.1 34.4 505.8 13.5 595.8 7.5 727.6 1.4 859.6 0 901.8 0 1238s1.4 378.4 7.5 510.4c6 131.8 26.9 221.8 57.5 300.5 31.6 81.4 73.9 150.5 142.8 219.3 68.8 68.8 137.8 111.1 219.3 142.8 78.8 30.6 168.7 51.5 300.5 57.5 132.1 6 174.2 7.5 510.4 7.5 336.3 0 378.4-1.4 510.4-7.5 131.8-6 221.8-26.9 300.5-57.5 81.4-31.7 150.4-74 219.3-142.8 68.8-68.8 111.1-137.9 142.8-219.3 30.6-78.7 51.6-168.7 57.5-300.5 6-132.1 7.4-174.2 7.4-510.4s-1.4-378.4-7.4-510.4c-6-131.8-26.9-221.8-57.5-300.5-31.7-81.4-74-150.4-142.8-219.3C2199.4 139 2130.3 96.6 2049 65c-78.8-30.6-168.8-51.6-300.5-57.5-132-6-174.2-7.5-510.4-7.5-336.3 0-378.4 1.4-510.5 7.5"></path>
                        </svg>
                    </a>
                </section>
                <section >
                    <a href="">
                        <svg class="icono-redes" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512" id="whatsapp">
                            <path fill-rule="evenodd" d="M209.877 154.114c-4.258-11.323-9.176-10.515-12.45-10.639-3.277-.121-6.146-.061-10.573.011-3.746.061-9.882 1.026-15.232 6.413-5.357 5.378-20.366 18.312-21.404 45.725-1.031 27.408 18.08 54.643 20.749 58.455 2.667 3.826 36.494 63.236 92.719 87.67 56.231 24.427 56.525 16.981 66.84 16.435 10.325-.54 33.726-12.246 38.899-25.073 5.172-12.827 5.588-23.979 4.271-26.358-1.316-2.371-5-3.911-10.51-6.9-5.516-2.995-32.595-17.498-37.673-19.55-5.081-2.044-8.787-3.108-12.742 2.329-3.957 5.422-15.191 17.569-18.596 21.168-3.42 3.6-6.711 3.934-12.226.93-5.5-2.988-23.373-9.548-44.098-29.317-16.126-15.38-26.711-34.043-29.779-39.736-3.069-5.697-.02-8.604 2.9-11.269 2.618-2.407 5.857-6.301 8.792-9.449 2.919-3.148 3.949-5.43 5.961-9.083 2.007-3.645 1.2-6.932-.102-9.771-1.303-2.838-11.49-30.668-15.746-41.991z" clip-rule="evenodd"></path>
                            <path d="M260.062 64c50.249 0 97.478 19.402 132.982 54.632C428.482 153.796 448 200.533 448 250.232c0 49.694-19.518 96.43-54.956 131.596-35.507 35.232-82.735 54.637-132.982 54.637-31.806 0-63.24-8.023-90.906-23.201l-12.017-6.593-13.063 4.149-61.452 19.522 19.375-57.149 4.798-14.151-7.771-12.763c-17.593-28.898-26.892-62.111-26.892-96.047 0-49.699 19.518-96.436 54.957-131.601C162.596 83.402 209.819 64 260.062 64m0-32C138.605 32 40.134 129.701 40.134 250.232c0 41.229 11.532 79.791 31.559 112.687L32 480l121.764-38.682c31.508 17.285 67.745 27.146 106.298 27.146C381.535 468.464 480 370.749 480 250.232 480 129.701 381.535 32 260.062 32z"></path>
                          </svg>
                    </a>
                </section>
            </article>

        </section>
    </footer>
    
<script src="{{ asset('js/slider.js') }}"></script>
<script src="{{ asset('js/nav-bar.js') }}"></script>
<script src="{{ asset('js/carrito.js') }}"></script>
</body>
</html>