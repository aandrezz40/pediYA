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
                    <a href="{{ url('/') }}">
                        <svg  class="icono-footer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="home">
                            <path d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"></path>
                        </svg>
                    </a>
                    
                    <h3>INICIO</h3>
                </section>
                <section class="cont-icono-footer">
                    <a href="{{ url('/nosotros') }}">
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
                    <a href="{{ url('/contacto') }}">
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