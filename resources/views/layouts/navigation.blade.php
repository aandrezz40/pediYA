<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<header>
    <section class="bar-logo">
        <img id="icono-nav-bar" class="icono-hamburguesa" src="{{ asset('img/icono-hamburguesa.png') }}" alt="">
        <h1 class="nombreEmpresa">PediYÁ</h1>
    </section>
    
    <section class="bar-search">
        <img class="icono-search" src="{{ asset('img/search_.png') }}" alt="">
        <input class="input-search" type="text" placeholder="Tiendas, productos...">
    </section>
    
    <section class="bar-buttons">
        <a class="button-ingreso" href="">Ingreso</a>
        <img class="icono-carrito-view" src="{{ asset('img/shopping-cart_.png') }}" alt="" id="abrirCarrito">
    </section>
</header>

    <aside id="cont-nav-bar">
        <section class="nav-bar">
            <div class=""><img class="icono-nav cerrar-nav" src="{{ asset('img/x-fill-12_.png') }}" alt="" id="close-nav-bar"></div>
            <div class="cont-icono">
                <svg  class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="home">
                <path d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"></path>
                </svg>
                <article class="container-links">
                    <h3>Pagina principal</h3>
                </article>
            </div>
            <div class="cont-icono">
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="service">
                    <path fill-rule="evenodd" d="M327.338,318.25c-.179,1.483-.467,2.969-.869,4.451l-.009-.003c-.075.273-.221.744-.435,1.409-1.672,5.194-4.571,9.705-8.304,13.355,11.417,1.464,24.516-.03,41.815-8.101l66.211-35.345c-.275-1.192-.779-2.373-1.525-3.496-1.739-2.616-4.445-4.225-7.541-4.912-3.926-.872-8.475-.348-12.784,1.411l-.013-.032-76.545,31.262h0ZM116.297,307.805l64.043-32.242c2.863-1.441,5.769-2.295,8.7-2.575,2.963-.283,6.089.025,9.354.912l98.6,26.761c.641.174.743.191.832.219,4.025,1.296,7.164,3.855,9.014,7.003,1.727,2.939,2.313,6.439,1.382,9.869v.037l-.149.556c-1.203,3.736-4.071,6.72-7.723,8.543-3.799,1.896-8.356,2.52-12.805,1.472-.272-.086-.546-.159-.821-.219l-50.239-13.189c-5.039-1.326-10.198,1.684-11.524,6.722-1.326,5.039,1.684,10.198,6.722,11.524l50.118,13.157c2.418.891,3.307,1.225,4.203,1.562,22.305,8.39,43.454,16.345,81.716-1.588l.443-.222,70.83-37.811c.407-.182.8-.392,1.177-.628l16.201-8.649c3.373-1.8,7.28-2.161,10.858-1.292,3.429.833,6.472,2.793,8.298,5.676l.21.328c1.464,2.491,1.711,5.274.954,7.842-.837,2.841-2.862,5.484-5.833,7.365l-.474.299-146.036,85.82c-3.083,1.811-6.359,2.924-9.742,3.327-3.398.405-6.913.088-10.46-.959l-41.964-12.395c-1.084-.32-1.638-.496-4.165-1.254-20.288-6.084-32.885-9.861-53.385,1.818l-26.24,14.949-62.095-102.741h0ZM113.81,489.291L17.371,329.727c-2.693-4.467-1.254-10.272,3.213-12.965l65.996-39.887c4.467-2.693,10.272-1.254,12.965,3.213l6.965,11.523,65.335-32.892c4.961-2.498,10.114-3.989,15.422-4.496,5.344-.51,10.714-.027,16.077,1.429l98.6,26.761c.195.053.741.224,1.645.515,8.58,2.762,15.378,8.405,19.504,15.424.205.349.403.701.595,1.056l73.116-29.862v-.037c7.719-3.152,16.232-4.009,23.939-2.298,7.709,1.712,14.58,5.923,19.213,12.891,1.054,1.584,1.933,3.229,2.644,4.915l4.906-2.619c7.605-4.059,16.29-4.903,24.155-2.991,8.013,1.947,15.265,6.754,19.822,13.95.087.138.253.415.506.845,4.254,7.239,4.982,15.288,2.801,22.691-2.1,7.128-6.926,13.597-13.885,18.003-.18.114-.506.31-.991.595l-146.036,85.82c-5.417,3.183-11.152,5.135-17.055,5.838-5.888.702-11.936.166-17.995-1.624l-46.203-13.649c-15.552-4.663-25.208-7.559-38.684.119l-25.791,14.693,7.835,12.962c2.693,4.467,1.254,10.272-3.213,12.965l-65.996,39.887c-4.467,2.693-10.272,1.254-12.965-3.213h0ZM38.429,328.049l86.668,143.397,49.829-30.116-86.667-143.397-49.83,30.116h0ZM342.539,37.05h-23.136l-5.232,16.318-.008-.003c-.944,2.93-3.302,5.339-6.493,6.208-3.555.97-7.066,2.177-10.513,3.606-3.305,1.37-6.615,3.004-9.91,4.888l-.007-.012c-2.681,1.53-6.058,1.716-9.006.197l-15.235-7.837-16.35,16.349,7.593,14.76c1.662,2.826,1.804,6.439.06,9.488-1.884,3.296-3.52,6.608-4.89,9.914-1.376,3.32-2.546,6.699-3.497,10.12-.715,3.141-3.023,5.834-6.313,6.89l-16.318,5.232v23.136l16.318,5.232-.003.008c2.93.944,5.339,3.302,6.208,6.493.97,3.555,2.177,7.066,3.605,10.513,1.369,3.305,3.005,6.615,4.889,9.911l-.012.007c1.53,2.681,1.716,6.058.197,9.006l-7.838,15.235,16.35,16.35,14.76-7.593c2.826-1.662,6.438-1.804,9.488-.06,3.296,1.884,6.608,3.52,9.915,4.89,3.32,1.375,6.699,2.546,10.12,3.497,3.141.715,5.834,3.023,6.89,6.313l5.232,16.318h23.136l5.232-16.318.008.003c.944-2.93,3.302-5.339,6.493-6.208,3.555-.97,7.065-2.177,10.513-3.605,3.305-1.37,6.616-3.005,9.911-4.889l.007.012c2.681-1.53,6.058-1.716,9.006-.197l15.235,7.837,16.349-16.349-7.593-14.76c-1.662-2.826-1.804-6.438-.06-9.488,1.884-3.296,3.52-6.608,4.89-9.914,1.376-3.321,2.546-6.7,3.497-10.12.716-3.141,3.023-5.834,6.313-6.89l16.318-5.232v-23.136l-16.318-5.232.003-.008c-2.93-.944-5.339-3.302-6.208-6.493-.97-3.555-2.178-7.066-3.606-10.513-1.369-3.305-3.005-6.616-4.889-9.911l.012-.007c-1.53-2.681-1.716-6.058-.197-9.006l7.837-15.235-16.349-16.349-14.76,7.593c-2.826,1.662-6.438,1.804-9.488.06-3.154-1.803-6.322-3.378-9.486-4.711-.156-.056-.312-.115-.466-.179-3.364-1.394-6.731-2.565-10.084-3.497-3.14-.716-5.833-3.024-6.889-6.312l-5.232-16.318h0ZM312.536,18.138v.028c-3.987-.001-7.692,2.547-8.976,6.547l-5.828,18.178c-2.644.859-5.225,1.812-7.74,2.855-2.607,1.08-5.124,2.234-7.545,3.459l-16.367-8.42c-3.638-2.211-8.446-1.745-11.591,1.399l-26.072,26.071.014.014c-2.824,2.823-3.641,7.253-1.713,10.993l8.72,16.95c-1.225,2.423-2.38,4.941-3.46,7.549-1.041,2.514-1.994,5.094-2.853,7.737l-17.442,5.592c-4.189.972-7.31,4.727-7.31,9.211v36.871h.028c0,3.987,2.547,7.692,6.547,8.976l18.178,5.828c.859,2.644,1.812,5.225,2.854,7.74,1.08,2.607,2.235,5.124,3.459,7.546l-8.42,16.367c-2.211,3.638-1.745,8.446,1.399,11.591l26.072,26.072.014-.014c2.823,2.824,7.253,3.641,10.993,1.713l16.951-8.72c2.423,1.225,4.941,2.38,7.549,3.461,2.513,1.041,5.094,1.994,7.736,2.853l5.592,17.442c.972,4.189,4.727,7.31,9.211,7.31h36.871v-.028c3.987.001,7.692-2.547,8.976-6.547l5.828-18.178c2.644-.859,5.225-1.812,7.74-2.854,2.607-1.08,5.124-2.235,7.546-3.459l16.367,8.42c3.638,2.211,8.446,1.745,11.591-1.399l26.071-26.071-.014-.014c2.824-2.823,3.641-7.253,1.713-10.993l-8.72-16.951c1.225-2.423,2.38-4.94,3.46-7.549,1.042-2.514,1.994-5.094,2.853-7.737l17.442-5.592c4.189-.972,7.31-4.727,7.31-9.211v-36.871h-.028c0-3.987-2.547-7.691-6.547-8.976l-18.178-5.828c-.86-2.644-1.812-5.225-2.854-7.74-1.08-2.607-2.235-5.124-3.459-7.546l8.42-16.367c2.211-3.638,1.745-8.446-1.399-11.591l-26.071-26.071-.014.014c-2.823-2.824-7.253-3.641-10.993-1.713l-16.951,8.72c-2.261-1.143-4.604-2.225-7.027-3.243-.159-.077-.32-.15-.485-.218-2.502-1.037-5.096-1.991-7.775-2.858l-5.59-17.437c-.972-4.189-4.727-7.31-9.211-7.31h-36.871ZM358.225,117.483c6.974,6.974,11.288,16.61,11.288,27.254s-4.314,20.28-11.288,27.254c-6.974,6.974-16.61,11.288-27.254,11.288s-20.28-4.314-27.254-11.288c-6.974-6.974-11.288-16.61-11.288-27.254s4.314-20.28,11.288-27.254c6.974-6.974,16.61-11.288,27.254-11.288s20.28,4.314,27.254,11.288h0ZM330.971,87.283c15.864,0,30.227,6.431,40.625,16.829,10.397,10.398,16.829,24.761,16.829,40.625s-6.431,30.228-16.829,40.625c-10.398,10.398-24.761,16.829-40.625,16.829s-30.227-6.431-40.625-16.829c-10.397-10.397-16.829-24.761-16.829-40.625s6.431-30.227,16.829-40.625c10.398-10.397,24.761-16.829,40.625-16.829Z"></path>
                </svg>
                <article class="container-links">
                    <h3>Servicios</h3>
                    <section class="links">
                        <a href="" class="link">Tiendas</a>
                        <a href="" class="link">Favoritos</a>
                        <a href="" class="link">Historial</a>
                    </section>
                </article>
            </div>
            <div class="cont-icono">
                <svg class="icono-nav"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="envelope">
                    <g>
                        <path d="M28.88,25.75H3.13a1.88,1.88,0,0,1-1.87-1.87V8.13A1.88,1.88,0,0,1,3.13,6.25H28.88a1.88,1.88,0,0,1,1.88,1.88V23.88A1.88,1.88,0,0,1,28.88,25.75ZM3.13,7.75a.38.38,0,0,0-.37.38V23.88a.38.38,0,0,0,.38.38H28.88a.38.38,0,0,0,.38-.37V8.13a.38.38,0,0,0-.37-.37Z"></path>
                        <rect width="10" height="1.5" x="6" y="17" rx=".75" ry=".75"></rect>
                        <rect width="5" height="1.5" x="6" y="13.5" rx=".75" ry=".75"></rect>
                        <path d="M25.45,19.5H21a1.3,1.3,0,0,1-1.3-1.3V13.8A1.3,1.3,0,0,1,21,12.5h4.4a1.3,1.3,0,0,1,1.3,1.3v4.4A1.3,1.3,0,0,1,25.45,19.5ZM21.25,18h4V14h-4Z"></path>
                    </g>
                </svg>
                <article class="container-links">
                    <h3>Sobre Nosotros</h3>
                </article>
            </div>
            <div class="cont-icono">
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" width="32" height="32" id="contacts">
                    <path d="M26 0H2a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM2 2h4v28H2V2zm24 28H8V2h18v28zM13.862 10.734a3.028 3.028 1080 1 0 6.056 0 3.028 3.028 1080 1 0-6.056 0zm3.09 4.238c-2.734 0-4.952 2.974-4.952 6.642s9.906 3.668 9.906 0-2.218-6.642-4.954-6.642zM30 2h2v6h-2zm0 8h2v6h-2zm0 8h2v6h-2z"></path>
                </svg>
                <article class="container-links">
                    <h3>Contacto</h3>
                </article>
            </div>
           <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn_exit">
                    <img class="logo-nav-bar" src="{{ asset('img/logo-v1.1.png') }}" alt="Cerrar sesión">
                </button>
            </form>
        </section>
    </aside>
<article class="overlay-carrito" id="overlayCarrito">
    <section class="cont-carrito" id="contCarrito">
        <article class="cont-buttons">
            <img src="{{ asset('img/x-fill-12_.png') }}" alt="" id="cerrarCarrito">
            <h2 class="titulo-carrito">PediYÁ</h2>
            <section class="num-productos">
                <img class="icono-carrito" src="{{ asset('img/shopping-cart_.png') }}" alt="">
                <span>2</span>
            </section>
        </article>
        <h2 class="tituloSecundario">¡Tú carrito!</h2>
        <article class="cont-cards">
            <article class="card-carrito">
                <section class="cont-acciones">
                    <h3 class="nombreTienda"><span></span>Nombre de la empresa</h3>
                    <img id="desplegarProducto" class="desplegarProducto" src="{{ asset('img/arrow-up-circle.svg') }}" alt="Desplegar producto">
                    <img class="eliminarProducto" src="{{ asset('img/x-fill-12_.png') }}" alt="Eliminar producto">
                </section>
                <section class="cont-productos">
                    <section class="cont-imagen-producto" id="cont-imagen-producto">
                        <section class="cont-datos-producto">
                            <img src="{{ asset('img/rice-ball_.png') }}" alt="">
                            <article class="contDescripcion">
                                <h3 class="nombreProducto">Arroz ROA</h3>
                                <p class="descripcionProducto">1 Libra</p>
                                <article class="cont-cantidad">
                                    <p class="precioProducto">$5000.00</p>
                                    <section class="cont-cantidad-producto">
                                        <button type="submit">-</button>
                                        <span>1</span>
                                        <button type="submit">+</button>
                                    </section>
                                </article>
                            </article>    
                        </section>
                        <article class="cont-confirmar">
                            <button type="submit">Confirmar</button>
                            <p>Subtotal: <span>$4.500</span></p>
                        </article>
                    </section>
                    <!-- Repite los cont-imagen-producto cuantas veces quieras -->
                    <section class="cont-imagen-producto" id="cont-imagen-producto">
                        <section class="cont-datos-producto">
                            <img src="{{ asset('img/rice-ball_.png') }}" alt="">
                            <article class="contDescripcion">
                                <h3 class="nombreProducto">Arroz ROA</h3>
                                <p class="descripcionProducto">1 Libra</p>
                                <article class="cont-cantidad">
                                    <p class="precioProducto">$5000.00</p>
                                    <section class="cont-cantidad-producto">
                                        <button type="submit">-</button>
                                        <span>1</span>
                                        <button type="submit">+</button>
                                    </section>
                                </article>
                            </article>    
                        </section>
                        <article class="cont-confirmar">
                            <button type="submit">Confirmar</button>
                            <p>Subtotal: <span>$4.500</span></p>
                        </article>
                    </section>
                    <!-- Puedes seguir duplicando o hacer un loop dinámico con Blade si quieres -->
                </section>
            </article>    
            <article class="card-carrito">
                <section class="cont-acciones">
                    <h3 class="nombreTienda"><span></span>Nombre de la empresa</h3>
                    <img class="desplegarProducto" src="{{ asset('img/arrow-up-circle.svg') }}" alt="Desplegar producto" id="desplegarProducto">
                    <img class="eliminarProducto" src="{{ asset('img/x-fill-12_.png') }}" alt="Eliminar producto">
                </section>
                <section class="cont-productos">
                    <section class="cont-imagen-producto" id="cont-imagen-producto">
                        <section class="cont-datos-producto">
                            <img src="{{ asset('img/rice-ball_.png') }}" alt="">
                            <article class="contDescripcion">
                                <h3 class="nombreProducto">Arroz ROA</h3>
                                <p class="descripcionProducto">1 Libra</p>
                                <article class="cont-cantidad">
                                    <p class="precioProducto">$5000.00</p>
                                    <section class="cont-cantidad-producto">
                                        <button type="submit">-</button>
                                        <span>1</span>
                                        <button type="submit">+</button>
                                    </section>
                                </article>
                            </article>    
                        </section>
                        <article class="cont-confirmar">
                            <button type="submit">Confirmar</button>
                            <p>Subtotal: <span>$4.500</span></p>
                        </article>
                    </section>
                </section>
            </article>    
        </article>
        <article class="cont-total">
            <h3>Total:</h3>
            <p>$4.500</p>
        </article>
    </section>
</article>

<script src="{{ asset('js/nav-bar.js') }}"></script>
<script src="{{ asset('js/carrito.js') }}"></script>