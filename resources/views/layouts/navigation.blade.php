    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
    
<header>
    <section class="bar-logo">
        <img id="icono-nav-bar" class="icono-hamburguesa" src="{{ asset('img/icono-hamburguesa.png') }}" alt="">
        <a href="{{ auth()->check() ? (auth()->user()->role === 'cliente' ? route('homeCliente') : (auth()->user()->role === 'tendero' ? route('homeTendero') : url('/'))) : url('/') }}">
            <h1 class="nombreEmpresa">PediYÁ</h1>
        </a>
        
        
    </section>

    @if(auth()->check() && auth()->user()->role === 'cliente')
    <form class="form-bar-search" action="{{ route('busquedaTienda') }}" method="post">
    @csrf
        <section class="bar-search">
            <img class="icono-search" src="{{ asset('img/search_.png') }}" alt="">
            <input class="input-search" name="nameStore" type="text" placeholder="Tiendas..." id="searchInput" autocomplete="off">
            <input class="btn-search" type="submit" value="Buscar">
            <div class="sugerencias-container" id="sugerenciasContainer" style="display: none;">
                <ul class="lista-sugerencias" id="listaSugerencias">
                </ul>
            </div>
        </section>
    </form>
    @endif

    
    <section class="bar-buttons">
        <article class="icono-notificacion-view" id="notificacionIcon">
            <img class="" src="{{ asset('img/bell-regular.svg') }}" alt="" srcset="">
            <section class="num-notificaciones" id="notificacionCount" style="display: none;">
                <span id="notificacionNumber">0</span>
            </section>
        </article>
        @if(auth()->check() && auth()->user()->role === 'cliente')
        <div class="cont-icono-carrito">
            <img class="icono-carrito-view" src="{{ asset('img/shopping-cart_.png') }}" alt="" id="abrirCarrito">
            <div class="contador-carrito {{ ($totalOrdersCount ?? 0) > 0 ? '' : 'hidden' }}" id="contadorCarrito">
                <span>{{ $totalOrdersCount ?? 0 }}</span>
            </div>
        </div>
        @endif
    </section>
</header>
    <section class="contenedor-notificaciones">
        <h2>Notificaciones</h2>
        <section class="cont-cards-notificacion">
            <article class="card-notificacion">
                <p class="texto-notificacion">Tu pedido realizado en la tienda: <span>Don Julio</span>, listo para recoger</p>
                <svg class="cerrar-notificacion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#7400C4" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
            </article>
            <article class="card-notificacion">
                <p class="texto-notificacion">Tu pedido realizado en la tienda: <span>Don Julio</span>, listo para recoger</p>
                <svg class="cerrar-notificacion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#7400C4" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
            </article>
    
        </section>
        <button type="submit">Limpiar notificaciones</button>
    </section>
    <aside id="cont-nav-bar">
        <section class="nav-bar">
            <div class=""><img class="icono-nav cerrar-nav" src="{{ asset('img/x-fill-12_.png') }}" alt="" id="close-nav-bar"></div>
            <div class="cont-icono">
                <a href="{{ url('/home') }}"><svg  class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="home">
                <path d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"></path></a>
                </svg>
                </a>
                <article class="container-links">
                    <h3>Panel principal</h3>
                </article>
            </div>
            @if(auth()->check() && auth()->user()->role === 'cliente')
            <div class="cont-icono">
                <a href="{{ url('/historialPedidos') }}">
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" width="35" height="40" fill=""
                    class="bi bi-receipt" viewBox="0 0 16 16">
                    <path
                        d="M1.92.506a.5.5 0 0 1 .58.092L4 2.087l1.5-1.49a.5.5 0 0 1 .707 0L8 2.087 9.793.598a.5.5 0 0 1 .707 0L12 2.087l1.5-1.49a.5.5 0 0 1 .832.374v14a.5.5 0 0 1-.832.374L12 14.087l-1.5 1.49a.5.5 0 0 1-.707 0L8 14.087l-1.793 1.49a.5.5 0 0 1-.707 0L4 14.087l-1.5 1.49a.5.5 0 0 1-.832-.374v-14a.5.5 0 0 1 .252-.432ZM3 3v10.379l1-1 2 2 2-2 2 2 2-2 1 1V3H3Zm2 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5Zm-.5 3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Z" />
                </svg>
                </a>
                <article class="container-links">
                    <h3>Pedidos</h3>
                    <!-- <section class="links">
                        <a href="" class="link">Tiendas</a>
                        <a href="" class="link">Favoritos</a>
                        <a href="" class="link">Historial</a>
                    </section> -->
                </article>
            </div>
            @endif
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
                    <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 16.933 16.933" id="book">
                        <path fill-rule="evenodd" d="M 14.003906,2 C 10.714471,2 8.0019531,4.7106393 8.0019531,8 V 55.998047 C 8.0019531,59.287483 10.714516,62 14.003906,62 h 35.994141 c 1.105287,-1.1e-4 2.000969,-0.896667 2,-2.001953 v -8.001953 h 2 c 1.104524,-1.1e-4 1.99989,-0.895476 2,-2 V 4 c -1.1e-4,-1.1045238 -0.895476,-1.9998896 -2,-2 z m 0,4 h 37.994141 v 42.003906 h -7.994141 c -2.837727,-0.182108 -2.837727,4.174296 0,3.992188 h 3.992188 v 6.001953 H 14.003906 c -1.14261,0 -2,-0.857373 -2,-2 v -2 c 0,-1.142627 0.85739,-2.001953 2,-2.001953 H 32 c 2.837727,0.182108 2.837727,-4.174296 0,-3.992188 H 14.003906 c -0.776667,0 -1.315927,0.559818 -2,0.833985 V 8 c 0,-1.1425512 0.857437,-2 2,-2 z M 32,14.001953 c -4.394589,0 -8.001953,3.599533 -8.001953,7.994141 0,2.125269 0.850337,4.061927 2.21875,5.5 C 22.517489,29.546629 19.998053,33.49083 19.998047,38 c -0.0605,2.726493 4.060499,2.726493 4,0 6e-6,-4.441928 3.559992,-8.001953 8.001953,-8.001953 4.441963,0 8.001949,3.560025 8.001953,8.001953 0,2.667968 4.001953,2.667968 4.001953,0 -5e-6,-4.50917 -2.519442,-8.453371 -6.21875,-10.503906 1.368413,-1.438073 2.216797,-3.374731 2.216797,-5.5 0,-4.394608 -3.607364,-7.994141 -8.001953,-7.994141 z m 0,4.001953 c 2.232828,0 4.001953,1.759356 4.001953,3.992188 0,2.232831 -1.769125,4.001953 -4.001953,4.001953 -2.232829,0 -4,-1.769122 -4,-4.001953 0,-2.232832 1.767171,-3.992188 4,-3.992188 z M 38,48 c -1.104576,0 -2.000008,0.895433 -2,2 1.5e-5,1.104567 0.895439,2 2,2 1.104559,0 1.999989,-0.895433 2,-2 8e-6,-1.104567 -0.895425,-2 -2,-2 z" color="#000" font-family="sans-serif" font-weight="400" overflow="visible" paint-order="stroke fill markers" style="line-height:normal;font-variant-ligatures:normal;font-variant-position:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-alternates:normal;font-feature-settings:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;text-orientation:mixed;shape-padding:0;isolation:auto;mix-blend-mode:normal" transform="scale(.26458)"></path>
                    </svg>
                </a>
                <article class="container-links">
                    <h3>Contacto</h3>
                </article>
            </div>
            <div class="cont-icono">
                <a href="{{ url('/perfil') }}">
                <svg class="icono-nav" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="settings" >
                    <g>
                      <g>
                        <path d="M12.94 22h-1.89a1.68 1.68 0 0 1-1.68-1.68v-1.09a.34.34 0 0 0-.22-.29.38.38 0 0 0-.41 0l-.74.8a1.67 1.67 0 0 1-2.37 0L4.26 18.4a1.66 1.66 0 0 1-.5-1.19 1.72 1.72 0 0 1 .5-1.21l.74-.74a.34.34 0 0 0 0-.37c-.06-.15-.16-.26-.3-.26H3.68A1.69 1.69 0 0 1 2 12.94v-1.89a1.68 1.68 0 0 1 1.68-1.68h1.09a.34.34 0 0 0 .29-.22.38.38 0 0 0 0-.41L4.26 8a1.67 1.67 0 0 1 0-2.37L5.6 4.26a1.65 1.65 0 0 1 1.18-.5 1.72 1.72 0 0 1 1.22.5l.74.74a.34.34 0 0 0 .37 0c.15-.06.26-.16.26-.3V3.68A1.69 1.69 0 0 1 11.06 2H13a1.68 1.68 0 0 1 1.68 1.68v1.09a.34.34 0 0 0 .22.29.38.38 0 0 0 .41 0l.69-.8a1.67 1.67 0 0 1 2.37 0l1.37 1.34a1.67 1.67 0 0 1 .5 1.19 1.63 1.63 0 0 1-.5 1.21l-.74.74a.34.34 0 0 0 0 .37c.06.15.16.26.3.26h1.09A1.69 1.69 0 0 1 22 11.06V13a1.68 1.68 0 0 1-1.68 1.68h-1.09a.34.34 0 0 0-.29.22.34.34 0 0 0 0 .37l.77.77a1.67 1.67 0 0 1 0 2.37l-1.31 1.33a1.65 1.65 0 0 1-1.18.5 1.72 1.72 0 0 1-1.19-.5l-.77-.74a.34.34 0 0 0-.37 0c-.15.06-.26.16-.26.3v1.09A1.69 1.69 0 0 1 12.94 22zm-1.57-2h1.26v-.77a2.33 2.33 0 0 1 1.46-2.14 2.36 2.36 0 0 1 2.59.47l.54.54.88-.88-.54-.55a2.34 2.34 0 0 1-.48-2.56 2.33 2.33 0 0 1 2.14-1.45H20v-1.29h-.77a2.33 2.33 0 0 1-2.14-1.46 2.36 2.36 0 0 1 .47-2.59l.54-.54-.88-.88-.55.54a2.39 2.39 0 0 1-4-1.67V4h-1.3v.77a2.33 2.33 0 0 1-1.46 2.14 2.36 2.36 0 0 1-2.59-.47l-.54-.54-.88.88.54.55a2.39 2.39 0 0 1-1.67 4H4v1.26h.77a2.33 2.33 0 0 1 2.14 1.46 2.36 2.36 0 0 1-.47 2.59l-.54.54.88.88.55-.54a2.39 2.39 0 0 1 4 1.67z"></path>
                        <path d="M12 15.5a3.5 3.5 0 1 1 3.5-3.5 3.5 3.5 0 0 1-3.5 3.5zm0-5a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"></path>
                      </g>
                    </g>
                  </svg>
                </a>
                <article class="container-links">
                    <h3>Ajustes de cuenta</h3>
                </article>
            </div>
           <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn_exit">
            <div class="cont-icono-salir">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="login">
                    <path d="M21 10h-2.6l.3-.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0l-2 2c-.1.1-.2.2-.2.3-.1.2-.1.5 0 .8.1.1.1.2.2.3l2 2c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4l-.3-.3H21c.6 0 1-.4 1-1s-.4-1-1-1zm-3 6z"></path>
                    <path d="M17 15c-.6 0-1 .4-1 1s-.4 1-1 1h-1V8.4c0-1.3-.8-2.4-1.9-2.8L10.5 5H15c.6 0 1 .4 1 1s.4 1 1 1 1-.4 1-1c0-1.7-1.3-3-3-3H5c-.1 0-.2 0-.3.1-.1 0-.2.1-.2.1l-.1.1c-.1 0-.2.1-.2.2v.1c-.1 0-.2.1-.2.2V18c0 .4.3.8.6.9l6.6 2.5c.2.1.5.1.7.1.4 0 .8-.1 1.1-.4.5-.4.9-1 .9-1.6V19h1c1.6 0 3-1.3 3-3 .1-.5-.4-1-.9-1zM6 17.3V5.4l5.3 2c.4.2.7.6.7 1v11.1l-6-2.2z"></path>
                </svg>
            </div>
                </button>
            </form>
        </section>
    </aside>
@if(auth()->check() && auth()->user()->role === 'cliente')
<article class="overlay-carrito" id="overlayCarrito">
    <section class="cont-carrito" id="contCarrito">
        <article class="cont-buttons">
            <img src="{{ asset('img/x-fill-12_.png') }}" alt="" id="cerrarCarrito">
            <h2 class="titulo-carrito">PediYÁ</h2>
        </article>
        <h2 class="tituloSecundario">¡Tú carrito!</h2>
        <article class="cont-cards-carrito">
            <div id="contenedorCarritoInterno">
                @include('partials._carrito')
            </div>
        </article>
        <article class="cont-total">
            <h3>Total:</h3>
            <p>${{ number_format($totalOrdersAmount, 0) }}</p>
        </article>
    </section>
</article>
@endif


<script>
// Autocompletado de búsqueda de tiendas
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sugerenciasContainer = document.getElementById('sugerenciasContainer');
    const listaSugerencias = document.getElementById('listaSugerencias');
    let timeoutId;

    // Función para buscar tiendas
    function buscarTiendas(query) {
        if (query.length < 2) {
            sugerenciasContainer.style.display = 'none';
            return;
        }

        fetch(`/buscar-tiendas?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(tiendas => {
                mostrarSugerencias(tiendas);
            })
            .catch(error => {
                console.error('Error al buscar tiendas:', error);
            });
    }

    // Función para mostrar sugerencias
    function mostrarSugerencias(tiendas) {
        listaSugerencias.innerHTML = '';
        
        if (tiendas.length === 0) {
            sugerenciasContainer.style.display = 'none';
            return;
        }

        tiendas.forEach(tienda => {
            const li = document.createElement('li');
            li.className = 'sugerencia-item';
            li.innerHTML = `
                <div class="sugerencia-nombre">${tienda.name}</div>
                <div class="sugerencia-descripcion">${tienda.description || 'Sin descripción'}</div>
            `;
            
            li.addEventListener('click', function() {
                // Redirigir a la página de detalles de la tienda
                window.location.href = `/detallesTienda/${tienda.id}`;
            });
            
            listaSugerencias.appendChild(li);
        });

        sugerenciasContainer.style.display = 'block';
    }

    // Event listener para el input de búsqueda
    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        const query = this.value.trim();
        
        timeoutId = setTimeout(() => {
            buscarTiendas(query);
        }, 300); // Debounce de 300ms
    });

    // Ocultar sugerencias al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !sugerenciasContainer.contains(e.target)) {
            sugerenciasContainer.style.display = 'none';
        }
    });

    // Ocultar sugerencias al presionar Escape
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            sugerenciasContainer.style.display = 'none';
        }
    });
});

// Función global para actualizar el contador del carrito
window.actualizarContadorCarrito = function(nuevoCount) {
    const contador = document.getElementById('contadorCarrito');
    const spanContador = contador.querySelector('span');
    
    if (nuevoCount > 0) {
        spanContador.textContent = nuevoCount;
        contador.classList.remove('hidden');
    } else {
        contador.classList.add('hidden');
    }
};
</script>

    


<script src="{{ asset('js/nav-bar.js') }}"></script>
<script src="{{ asset('js/carrito.js') }}"></script>