<x-app-layout>
<main class="main-detalles-tienda">
    <!--BANNER DETALLES DE LA TIENDA-->
    <section class="cont-baner">
        <article class="cont-img-tienda">
            <img class="img-tienda" src="{{ asset('img/slider-3.jpg') }}" alt="">
        </article>
        <article class="cont-info">
            <h2>{{$store->name}}</h2>
            <section class="cont-horario">
                <img src="{{ asset('img/clock-solid.svg') }}" alt="">
                <h3>{{ $store->is_open ? 'Abierto' : 'Cerrado' }}</h3>
            </section>
            <article class="cont-acciones-tienda">
                <button type="submit" class="btn-llamar" ><img src="{{ asset('img/phone-solid (1).svg') }}" alt="Imagen de telefono">{{$store->delivery_contact_phone}}</button>
                <button type="submit" class="btn-favorito"><img src="{{ asset('img/heart-solid.svg') }}" alt="Imagen de corazón">Favorito</button>
                @if ($store->offers_delivery == 1)
                <button type="submit" class="btn-mapa"><img src="{{ asset('img/scooter.svg') }}" alt="Imagen de pin de mapa">Domicilio</button>
                @endif
            </article>
        </article>
    </section>

    <!--MINI NAV-BAR-->
    <section class="cont-opcion">
        <ul>
            <li><a href="#" id="verProductos">Porductos</a></li>
            <li><a href="#" id="verDetalles">Detalles</a></li>
        </ul>
    </section>

    <!--CONTENEDOR DE LA SECCION PRODUCTOS-->
    <section class="cont-productos-tienda" id="contProductosTienda">
        <h2 class="tituloProductos">Productos</h2>
        <article class="cont-categorias">
            <button type="submit" class="btn-categoria" data-category-id="0">Todos</button>
            @forelse ($categories as $category)
            <button type="submit" class="btn-categoria" data-category-id="{{ $category->id }}">{{ $category->name }}</button>
            @empty
            <p class="mensaje-vacio">No hay categorias</p>
            @endforelse
        </article>
        <article class="cont-cards-productos">
            @forelse ($products as $product)
            <article id="" class="card-producto">
                <section class="cont-img-tienda-producto">
                    <img src="{{ asset('img/apple-2788616_640.jpg') }}" alt="">
                </section>
                <section class="cont-info-producto">
                    <h3>{{$product->name}}</h3>
                    <p class="descripcionProducto">{{$product->description}}</p>
                    <article class="cont-precio">
                        <p class="precioProducto">{{$product->price}}</p>
                        <section class="cont-cantidad-producto-detalles">
                            <button type="submit">-</button>
                            <span>1</span>
                            <button type="submit">+</button>
                        </section>
                    </article>
                </section>
            </article>
            @empty
                <p class="mensaje-vacio">La tienda no tiene productos disponibles</p>
            @endforelse
        </article>
    </section>

    <!--CONTENEDOR DE LA SECCION DE DETALLES-->
    <section class="cont-detalles-tienda animate__animated animate__fadeInRight" id="contDetallesTienda">
        <h2 class="tituloDetalles">Detalles Tienda</h2>

        <article class="cont-datos">
            <section class="sect-dato">
                <img src="{{ asset('img/map.svg') }}" alt="">
                <article class="sect-info">
                    <h3>Dirección</h3>
                    <p>{{$store->address_street}}, {{$store->address_neighborhood }}</p>
                </article>
            </section>
            <section class="sect-dato">
                <img src="{{ asset('img/clock-1.svg') }}" alt="">
                <article class="sect-info">
                    <h3>Horario</h3>
                    <p>{{$store->schedule }}</p>
                </article>
            </section>
            <section class="sect-dato">
                <img src="{{ asset('img/icons8-parte-trasera-de-tarjeta-bancaria-48.png') }}" alt="">
                <article class="sect-info">
                    <h3>Métodos de pago</h3>
                    <p>Efectivo, Tarjetas de crédito, Transferencia, Nequi, Daviplata</p>
                </article>
            </section>
        </article>
        <article class="cont-info-adicional">
            <section class="info-adicional">
                <img src="{{ asset('img/icons8-acerca-de-48.png') }}" alt="">
                <article>
                    <h3>Acerca de</h3>
                    <p>{{$store->description }}</p>
                </article>
            </section>
            <section class="info-adicional">
                <img src="{{ asset('img/person-16.svg') }}" alt="">
                <article>
                    <h3>Propietario</h3>
                    <p>{{$owner->name }}</p>
                    <p>En PediYÁ desde {{$owner->created_at }}</p>
                </article>
            </section>
        </article>
    </section>
</main>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.btn-categoria').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const categoryId = btn.dataset.categoryId;

            fetch(`/product/${categoryId}/{{$store->id}}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const productosContenedor = document.querySelector('.cont-cards-productos');
                    productosContenedor.innerHTML = ''; // Limpiar productos anteriores

                    if (data.products.length === 0) {
                        productosContenedor.innerHTML = '<p class="mensaje-vacio">No hay productos en esta categoría</p>';
                    } else {
                        data.products.forEach(product => {
                            productosContenedor.innerHTML += `
                                <article class="card-producto">
                                    <section class="cont-img-tienda-producto">
                                        <img src="/img/apple-2788616_640.jpg" alt="">
                                    </section>
                                    <section class="cont-info-producto">
                                        <h3>${product.name}</h3>
                                        <p class="descripcionProducto">${product.description ?? ''}</p>
                                        <article class="cont-precio">
                                            <p class="precioProducto">$${parseFloat(product.price).toFixed(2)}</p>
                                            <section class="cont-cantidad-producto-detalles">
                                                <button type="submit">-</button>
                                                <span>1</span>
                                                <button type="submit">+</button>
                                            </section>
                                        </article>
                                    </section>
                                </article>
                            `;
                        });
                    }
                }
            })
            .catch(error => {
                console.error("Error al cargar productos:", error);
            });
        });
    });
</script>


</x-app-layout>
