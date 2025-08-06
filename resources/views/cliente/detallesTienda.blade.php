<x-app-layout>
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/users/detallesTienda.css') }}">
@endsection

<article class="main-detalles-tienda" data-store-id="{{ $store->id }}">
    <!-- BANNER DETALLES DE LA TIENDA -->
    <section class="cont-baner-detalles-tienda">
        <article class="cont-img-tienda-detalle">
            <img class="img-tienda" src="{{ asset('img/slider-3.jpg') }}" alt="">
        </article>
        <article class="cont-info">
            <h2>{{ $store->name }}</h2>
            <section class="cont-horario">
                <h3>Actualmente la Tienda está: {{ $store->is_open ? 'Abierta' : 'Cerrada' }}</h3>
            </section>
            <article class="cont-acciones-tienda">
                <button type="submit" class="btn-llamar">
                    <img src="{{ asset('img/phone-solid (1).svg') }}" alt="Imagen de teléfono">{{ $store->delivery_contact_phone }}
                </button>
                {{-- <button type="submit" class="btn-favorito">
                    <img src="{{ asset('img/heart-solid.svg') }}" alt="Imagen de corazón">Favorito
                </button> --}}
                @if ($store->offers_delivery == 1)
                    <button type="submit" class="btn-mapa">
                        <img src="{{ asset('img/scooter.svg') }}" alt="Imagen de pin de mapa">Domicilio
                    </button>
                @endif
            </article>
        </article>
        <label class="estrella-container">
            <input type="checkbox" class="toggle-favorito" 
                   data-store-id="{{ $store->id }}"
                   {{ auth()->user()->favoriteStores->contains($store->id) ? 'checked' : '' }}>
            <span class="estrella {{ auth()->user()->favoriteStores->contains($store->id) ? 'favorito' : '' }}">★</span>
        </label>
    </section>

    <!-- MINI NAV-BAR -->
    <section class="cont-opcion">
        <ul>
            <li><a href="#" id="verProductos">Productos</a></li>
            <li><a href="#" id="verDetalles">Detalles</a></li>
        </ul>
    </section>

    <!-- CONTENEDOR DE LA SECCIÓN PRODUCTOS -->
    <section class="cont-productos-tienda" id="contProductosTienda">
        <h2 class="tituloProductos">Productos</h2>
        <article class="cont-categorias">
            <button type="submit" class="btn-categoria" data-category-id="0">Todos</button>
            @forelse ($categories as $category)
                <button type="submit" class="btn-categoria" data-category-id="{{ $category->id }}">{{ $category->name }}</button>
            @empty
                <p class="mensaje-vacio">No hay categorías</p>
            @endforelse
        </article>

        <article class="cont-cards-productos">
            @forelse ($products as $product)
                <article class="card-producto" data-category-id="{{ $product->category_id ?? 0 }}">
                    <section class="cont-img-tienda-producto">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </section>
                    <section class="cont-info-producto">
                        <h3>{{ $product->name }}</h3>
                        <p class="descripcionProducto">{{ $product->description }}</p>
                        <article class="cont-precio">
                            <p class="precioProducto">${{ $product->price }}</p>

                            <!-- FORMULARIO INDIVIDUAL DE CADA PRODUCTO -->

                        </article>
                        <form method="POST" action="{{ route('cliente.pedido.agregar') }}" class="form-agregar-producto">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="store_id" value="{{ $store->id }}">
                            <input type="hidden" name="cantidad" class="input-cantidad-producto" value="0">

                            

                            <article class="cont-boton-cantidad-producto">
                                <input type="submit" value="✔" class="btn-confirmar-cantidad-producto">
                                <button type="button" class="disminuir-cantidad-producto">-</button>
                                <span class="cantidad-producto-detalles-tienda">0</span>
                                <button type="button" class="aumentar-cantidad-producto">+</button>
                            </article>
                        </form>
                    </section>
                </article>
            @empty
                <p class="mensaje-vacio">La tienda no tiene productos disponibles</p>
            @endforelse
        </article>
        <div id="mensaje-flotante" class="mensaje-flotante-confirmacion animate__animated animate__fadeIn">
                Producto agregado correctamente
        </div>
    </section>

    <!-- CONTENEDOR DE LA SECCIÓN DE DETALLES -->
    <section class="cont-detalles-tienda animate__animated animate__fadeInRight" id="contDetallesTienda">
        <h2 class="tituloDetalles">Detalles Tienda</h2>

        <article class="cont-datos">
            <section class="sect-dato">
                <img src="{{ asset('img/map-location-dot-solid.svg') }}" alt="">
                <article class="sect-info">
                    <h3>Dirección</h3>
                    <p>{{ $store->address_street }}, {{ $store->address_neighborhood }}</p>
                </article>
            </section>

            <section class="sect-dato">
                <img src="{{ asset('img/clock-solid.svg') }}" alt="">
                <article class="sect-info">
                    <h3>Horario</h3>
                    <p>{{ $store->schedule }}</p>
                </article>
            </section>

            <section class="sect-dato">
                <img src="{{ asset('img/credit-card-solid.svg') }}" alt="">
                <article class="sect-info">
                    <h3>Métodos de pago</h3>
                    <p>{{ $store->payment_methods_formatted }}</p>
                </article>
            </section>
        </article>

        <article class="cont-info-adicional">
            <section class="info-adicional">
                <img src="{{ asset('img/circle-info-solid.svg') }}" alt="">
                <article>
                    <h3>Acerca de</h3>
                    <p>{{ $store->description }}</p>
                </article>
            </section>
            <section class="info-adicional">
                <img src="{{ asset('img/person-16.svg') }}" alt="">
                <article>
                    <h3>Propietario</h3>
                    <p>{{ $owner->name }}</p>
                    <p>En PediYÁ desde {{ $owner->created_at }}</p>
                </article>
            </section>
        </article>
    </section>
</article>

@section('scripts')
    <script src="{{ asset('js/detallesTienda.js') }}"></script>
<script>
// Funcionalidad de favoritos con AJAX
document.addEventListener('DOMContentLoaded', function() {
    const toggleFavorito = document.querySelector('.toggle-favorito');
    
    if (toggleFavorito) {
        toggleFavorito.addEventListener('change', function() {
            const storeId = this.dataset.storeId;
            const estrella = this.nextElementSibling;
            const isFavorito = this.checked;
            
            // URL para agregar o quitar favorito
            const url = isFavorito 
                ? `/store/${storeId}/favorite`
                : `/store/${storeId}/unfavorite`;
            
            // Token CSRF
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cambiar estilo de la estrella
                    if (isFavorito) {
                        estrella.classList.add('favorito');

                    } else {
                        estrella.classList.remove('favorito');

                    }
                } else {
                    // Revertir el checkbox si hay error
                    this.checked = !isFavorito;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revertir el checkbox si hay error
                this.checked = !isFavorito;
            });
        });
    }
});

// Funcionalidad de filtrado por categorías con JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const categoriaButtons = document.querySelectorAll('.btn-categoria');
    const productCards = document.querySelectorAll('.card-producto');
    
    // Función para filtrar productos
    function filtrarProductos(categoryId) {
        productCards.forEach(card => {
            const cardCategoryId = card.dataset.categoryId;
            
            if (categoryId === '0' || cardCategoryId === categoryId.toString()) {
                card.style.display = 'block';
                card.classList.add('animate__animated', 'animate__fadeIn');
            } else {
                card.style.display = 'none';
                card.classList.remove('animate__animated', 'animate__fadeIn');
            }
        });
        
        // Verificar si hay productos visibles
        const productosVisibles = document.querySelectorAll('.card-producto[style*="display: block"]');
        const mensajeVacio = document.querySelector('.mensaje-vacio');
        
        if (productosVisibles.length === 0) {
            if (!mensajeVacio) {
                const mensaje = document.createElement('p');
                mensaje.className = 'mensaje-vacio';
                mensaje.textContent = 'No hay productos en esta categoría';
                document.querySelector('.cont-cards-productos').appendChild(mensaje);
            }
        } else {
            if (mensajeVacio && mensajeVacio.textContent === 'No hay productos en esta categoría') {
                mensajeVacio.remove();
            }
        }
    }
    
    // Event listeners para los botones de categoría
    categoriaButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remover clase activa de todos los botones
            categoriaButtons.forEach(btn => btn.classList.remove('btn-categorias-activo'));
            
            // Agregar clase activa al botón clickeado
            this.classList.add('btn-categorias-activo');
            
            // Filtrar productos
            const categoryId = this.dataset.categoryId;
            filtrarProductos(categoryId);
        });
    });
    
    // Activar "Todos" por defecto
    const btnTodos = document.querySelector('.btn-categoria[data-category-id="0"]');
    if (btnTodos) {
        btnTodos.classList.add('btn-categorias-activo');
    }
});

document.querySelectorAll('.form-agregar-producto').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const cantidadSpan = this.querySelector('.cantidad-producto-detalles-tienda');
        const cantidad = parseInt(cantidadSpan.innerText);
        if (cantidad <= 0) {
            alert('Debes seleccionar una cantidad mayor a 0.');
            return;
        }

        const formData = new FormData(this);
        formData.set('cantidad', cantidad);

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token')
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            mostrarMensaje(data.mensaje || 'Producto agregado con éxito');

            // ✅ ACTUALIZAR CARRITO
            if (data.carritoHtml) {
                const contenedor = document.getElementById('contenedorCarritoInterno');
                if (contenedor) {
                    contenedor.innerHTML = data.carritoHtml;
                }

                // ✅ Actualizar contador y total
                const spanCantidad = document.querySelector('.num-productos span');
                if (spanCantidad) spanCantidad.textContent = data.totalCount;

                const totalTexto = document.querySelector('.cont-total p');
                if (totalTexto) totalTexto.innerHTML = `$${data.totalAmount}`;

                // ✅ Actualizar contador del carrito en la navegación
                if (window.actualizarContadorCarrito) {
                    window.actualizarContadorCarrito(data.totalCount);
                } else {
                    // Fallback si la función no está disponible
                    const contadorCarrito = document.getElementById('contadorCarrito');
                    const spanContador = contadorCarrito?.querySelector('span');
                    if (spanContador) {
                        spanContador.textContent = data.totalCount;
                        if (data.totalCount > 0) {
                            contadorCarrito.classList.remove('hidden');
                        } else {
                            contadorCarrito.classList.add('hidden');
                        }
                    }
                }

                inicializarEventosCarrito();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarMensaje('Error al agregar producto', true);
        });
    });
});

function mostrarMensaje(texto, error = false) {
    const mensaje = document.getElementById('mensaje-flotante');
    mensaje.innerText = texto;
    mensaje.style.background = error ? '#dc3545' : '#62238D';
    mensaje.style.display = 'block';
    setTimeout(() => {
        mensaje.style.display = 'none';
    }, 2500);
}

</script>

@endsection

</x-app-layout>
