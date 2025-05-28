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
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill=""
                    class="bi bi-receipt" viewBox="0 0 16 16">
                    <path
                        d="M1.92.506a.5.5 0 0 1 .58.092L4 2.087l1.5-1.49a.5.5 0 0 1 .707 0L8 2.087 9.793.598a.5.5 0 0 1 .707 0L12 2.087l1.5-1.49a.5.5 0 0 1 .832.374v14a.5.5 0 0 1-.832.374L12 14.087l-1.5 1.49a.5.5 0 0 1-.707 0L8 14.087l-1.793 1.49a.5.5 0 0 1-.707 0L4 14.087l-1.5 1.49a.5.5 0 0 1-.832-.374v-14a.5.5 0 0 1 .252-.432ZM3 3v10.379l1-1 2 2 2-2 2 2 2-2 1 1V3H3Zm2 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5Zm-.5 3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Z" />
                </svg>
                <article class="container-links">
                    <h3>Pedidos</h3>
                    {{-- <section class="links">
                        <a href="" class="link">Tiendas</a>
                        <a href="" class="link">Favoritos</a>
                        <a href="" class="link">Historial</a>
                    </section> --}}
                </article>
            </div>
            <div class="cont-icono">
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="envelope">
                    <g>
                        <path
                            d="M28.88,25.75H3.13a1.88,1.88,0,0,1-1.87-1.87V8.13A1.88,1.88,0,0,1,3.13,6.25H28.88a1.88,1.88,0,0,1,1.88,1.88V23.88A1.88,1.88,0,0,1,28.88,25.75ZM3.13,7.75a.38.38,0,0,0-.37.38V23.88a.38.38,0,0,0,.38.38H28.88a.38.38,0,0,0,.38-.37V8.13a.38.38,0,0,0-.37-.37Z">
                        </path>
                        <rect width="10" height="1.5" x="6" y="17" rx=".75" ry=".75"></rect>
                        <rect width="5" height="1.5" x="6" y="13.5" rx=".75" ry=".75"></rect>
                        <path
                            d="M25.45,19.5H21a1.3,1.3,0,0,1-1.3-1.3V13.8A1.3,1.3,0,0,1,21,12.5h4.4a1.3,1.3,0,0,1,1.3,1.3v4.4A1.3,1.3,0,0,1,25.45,19.5ZM21.25,18h4V14h-4Z">
                        </path>
                    </g>
                </svg>
                <article class="container-links">
                    <h3>Sobre Nosotros</h3>
                </article>
            </div>
            <div class="cont-icono">
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 16.933 16.933" id="book">
                    <path fill-rule="evenodd" d="M 14.003906,2 C 10.714471,2 8.0019531,4.7106393 8.0019531,8 V 55.998047 C 8.0019531,59.287483 10.714516,62 14.003906,62 h 35.994141 c 1.105287,-1.1e-4 2.000969,-0.896667 2,-2.001953 v -8.001953 h 2 c 1.104524,-1.1e-4 1.99989,-0.895476 2,-2 V 4 c -1.1e-4,-1.1045238 -0.895476,-1.9998896 -2,-2 z m 0,4 h 37.994141 v 42.003906 h -7.994141 c -2.837727,-0.182108 -2.837727,4.174296 0,3.992188 h 3.992188 v 6.001953 H 14.003906 c -1.14261,0 -2,-0.857373 -2,-2 v -2 c 0,-1.142627 0.85739,-2.001953 2,-2.001953 H 32 c 2.837727,0.182108 2.837727,-4.174296 0,-3.992188 H 14.003906 c -0.776667,0 -1.315927,0.559818 -2,0.833985 V 8 c 0,-1.1425512 0.857437,-2 2,-2 z M 32,14.001953 c -4.394589,0 -8.001953,3.599533 -8.001953,7.994141 0,2.125269 0.850337,4.061927 2.21875,5.5 C 22.517489,29.546629 19.998053,33.49083 19.998047,38 c -0.0605,2.726493 4.060499,2.726493 4,0 6e-6,-4.441928 3.559992,-8.001953 8.001953,-8.001953 4.441963,0 8.001949,3.560025 8.001953,8.001953 0,2.667968 4.001953,2.667968 4.001953,0 -5e-6,-4.50917 -2.519442,-8.453371 -6.21875,-10.503906 1.368413,-1.438073 2.216797,-3.374731 2.216797,-5.5 0,-4.394608 -3.607364,-7.994141 -8.001953,-7.994141 z m 0,4.001953 c 2.232828,0 4.001953,1.759356 4.001953,3.992188 0,2.232831 -1.769125,4.001953 -4.001953,4.001953 -2.232829,0 -4,-1.769122 -4,-4.001953 0,-2.232832 1.767171,-3.992188 4,-3.992188 z M 38,48 c -1.104576,0 -2.000008,0.895433 -2,2 1.5e-5,1.104567 0.895439,2 2,2 1.104559,0 1.999989,-0.895433 2,-2 8e-6,-1.104567 -0.895425,-2 -2,-2 z" color="#000" font-family="sans-serif" font-weight="400" overflow="visible" paint-order="stroke fill markers" style="line-height:normal;font-variant-ligatures:normal;font-variant-position:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-alternates:normal;font-feature-settings:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;text-orientation:mixed;shape-padding:0;isolation:auto;mix-blend-mode:normal" transform="scale(.26458)"></path>
                  </svg>
                <article class="container-links">
                    <h3>Contacto</h3>
                </article>
            </div>
            <div class="cont-icono">
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="settings" >
                    <g>
                      <g>
                        <path d="M12.94 22h-1.89a1.68 1.68 0 0 1-1.68-1.68v-1.09a.34.34 0 0 0-.22-.29.38.38 0 0 0-.41 0l-.74.8a1.67 1.67 0 0 1-2.37 0L4.26 18.4a1.66 1.66 0 0 1-.5-1.19 1.72 1.72 0 0 1 .5-1.21l.74-.74a.34.34 0 0 0 0-.37c-.06-.15-.16-.26-.3-.26H3.68A1.69 1.69 0 0 1 2 12.94v-1.89a1.68 1.68 0 0 1 1.68-1.68h1.09a.34.34 0 0 0 .29-.22.38.38 0 0 0 0-.41L4.26 8a1.67 1.67 0 0 1 0-2.37L5.6 4.26a1.65 1.65 0 0 1 1.18-.5 1.72 1.72 0 0 1 1.22.5l.74.74a.34.34 0 0 0 .37 0c.15-.06.26-.16.26-.3V3.68A1.69 1.69 0 0 1 11.06 2H13a1.68 1.68 0 0 1 1.68 1.68v1.09a.34.34 0 0 0 .22.29.38.38 0 0 0 .41 0l.69-.8a1.67 1.67 0 0 1 2.37 0l1.37 1.34a1.67 1.67 0 0 1 .5 1.19 1.63 1.63 0 0 1-.5 1.21l-.74.74a.34.34 0 0 0 0 .37c.06.15.16.26.3.26h1.09A1.69 1.69 0 0 1 22 11.06V13a1.68 1.68 0 0 1-1.68 1.68h-1.09a.34.34 0 0 0-.29.22.34.34 0 0 0 0 .37l.77.77a1.67 1.67 0 0 1 0 2.37l-1.31 1.33a1.65 1.65 0 0 1-1.18.5 1.72 1.72 0 0 1-1.19-.5l-.77-.74a.34.34 0 0 0-.37 0c-.15.06-.26.16-.26.3v1.09A1.69 1.69 0 0 1 12.94 22zm-1.57-2h1.26v-.77a2.33 2.33 0 0 1 1.46-2.14 2.36 2.36 0 0 1 2.59.47l.54.54.88-.88-.54-.55a2.34 2.34 0 0 1-.48-2.56 2.33 2.33 0 0 1 2.14-1.45H20v-1.29h-.77a2.33 2.33 0 0 1-2.14-1.46 2.36 2.36 0 0 1 .47-2.59l.54-.54-.88-.88-.55.54a2.39 2.39 0 0 1-4-1.67V4h-1.3v.77a2.33 2.33 0 0 1-1.46 2.14 2.36 2.36 0 0 1-2.59-.47l-.54-.54-.88.88.54.55a2.39 2.39 0 0 1-1.67 4H4v1.26h.77a2.33 2.33 0 0 1 2.14 1.46 2.36 2.36 0 0 1-.47 2.59l-.54.54.88.88.55-.54a2.39 2.39 0 0 1 4 1.67z"></path>
                        <path d="M12 15.5a3.5 3.5 0 1 1 3.5-3.5 3.5 3.5 0 0 1-3.5 3.5zm0-5a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"></path>
                      </g>
                    </g>
                  </svg>
                <article class="container-links">
                    <h3>Ajustes de cuenta</h3>
                    <!-- <section class="links">
                        <a href="" class="link">Tiendas</a>
                        <a href="" class="link">Favoritos</a>
                        <a href="" class="link">Historial</a>
                    </section> -->
                </article>
            </div>
            <div class="cont-icono-salir">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="login">
                    <path d="M21 10h-2.6l.3-.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0l-2 2c-.1.1-.2.2-.2.3-.1.2-.1.5 0 .8.1.1.1.2.2.3l2 2c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4l-.3-.3H21c.6 0 1-.4 1-1s-.4-1-1-1zm-3 6z"></path>
                    <path d="M17 15c-.6 0-1 .4-1 1s-.4 1-1 1h-1V8.4c0-1.3-.8-2.4-1.9-2.8L10.5 5H15c.6 0 1 .4 1 1s.4 1 1 1 1-.4 1-1c0-1.7-1.3-3-3-3H5c-.1 0-.2 0-.3.1-.1 0-.2.1-.2.1l-.1.1c-.1 0-.2.1-.2.2v.1c-.1 0-.2.1-.2.2V18c0 .4.3.8.6.9l6.6 2.5c.2.1.5.1.7.1.4 0 .8-.1 1.1-.4.5-.4.9-1 .9-1.6V19h1c1.6 0 3-1.3 3-3 .1-.5-.4-1-.9-1zM6 17.3V5.4l5.3 2c.4.2.7.6.7 1v11.1l-6-2.2z"></path>
                </svg>
            </div>
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