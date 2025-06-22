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
                <h3>Actualmente la Tienda está: {{ $store->is_open ? 'Abierto' : 'Cerrado' }}</h3>
            </section>
            <article class="cont-acciones-tienda">
                <button type="submit" class="btn-llamar">
                    <img src="{{ asset('img/phone-solid (1).svg') }}" alt="Imagen de teléfono">{{ $store->delivery_contact_phone }}
                </button>
                <button type="submit" class="btn-favorito">
                    <img src="{{ asset('img/heart-solid.svg') }}" alt="Imagen de corazón">Favorito
                </button>
                @if ($store->offers_delivery == 1)
                    <button type="submit" class="btn-mapa">
                        <img src="{{ asset('img/scooter.svg') }}" alt="Imagen de pin de mapa">Domicilio
                    </button>
                @endif
            </article>
        </article>
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
                <article class="card-producto">
                    <section class="cont-img-tienda-producto">
                        <img src="{{ asset('img/apple-2788616_640.jpg') }}" alt="">
                    </section>
                    <section class="cont-info-producto">
                        <h3>{{ $product->name }}</h3>
                        <p class="descripcionProducto">{{ $product->description }}</p>
                        <article class="cont-precio">
                            <p class="precioProducto">${{ $product->price }}</p>

                            <!-- FORMULARIO INDIVIDUAL DE CADA PRODUCTO -->
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
                        </article>
                    </section>
                </article>
            @empty
                <p class="mensaje-vacio">La tienda no tiene productos disponibles</p>
            @endforelse
        </article>
        <div id="mensaje-flotante" style="display:none; position:fixed; top:20px; right:20px; background:#28a745; color:white; padding:10px 20px; border-radius:8px; z-index:9999;">
                Producto agregado
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
                    <p>Efectivo, Tarjetas de crédito, Transferencia, Nequi, Daviplata</p>
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
    mensaje.style.background = error ? '#dc3545' : '#28a745';
    mensaje.style.display = 'block';
    setTimeout(() => {
        mensaje.style.display = 'none';
    }, 2500);
}

</script>

@endsection

</x-app-layout>
