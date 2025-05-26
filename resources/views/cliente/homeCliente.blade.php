<x-app-layout>
    <main>
        <section class="cont-nombre-usuario">
            <h2>¡Hola, {{Auth::user()->name}}!</h2>
            <p>¿Qué deseas ordenar hoy en tus tiendas favoritas?</p>
        </section>
        <section class="cont-bienvenido">
            <article>
                <h2>¡Te damos la bienvenida!</h2>
                <p>Explora todas nuestras tiendas disponibles.</p>
            </article>
            <article>
                <button type="submit" class="btn-buscarTiendas"  onclick="location.href='#tiendasCercanas'">Buscar</button>
            </article>
        </section>
            <!--CONTENEDOR DE CARDS DE TIENDAS FAVORITOS---->
<section id="favorite-stores" class="cont-cards-tiendas">
    @forelse ($favoriteStores as $store)
        <article id="store-{{ $store->id }}" class="card-tienda">
            <section class="cont-img">
                <p>{{ $store->is_open ? 'Abierto' : 'Cerrado' }}</p>

                <label class="estrella-container">
                    <input type="checkbox" class="toggle-favorito" data-store-id="{{ $store->id }}" checked>
                    <span class="estrella">★</span>
                </label>

                <img src="{{ $store->logo_path ? asset('storage/' . $store->logo_path) : asset('img/slider-1.jpg') }}" alt="Imagen de la tienda">
            </section>

            <section class="cont-info-tienda">
                <h3>{{ $store->name }}</h3>
                <p>{{ $store->is_open ? 'Abierto' : 'Cerrado' }}</p>
                <p>{{ $store->address_street }}, {{ $store->address_neighborhood }}</p>
                <form action="" method="GET">
                    <button type="submit">Ver tienda</button>
                </form>
            </section>
        </article>
    @empty
        <p class="mensaje-vacio">No tienes tiendas favoritas todavía.</p>
    @endforelse
</section>

        <!--CONTENEDOR DE CARDS DE TIENDAS CERCANAS---->
        <section class="titulo-contenedor" id="tiendasCercanas">
            <h2>Tiendas cercanas</h2>
        </section>
        <section class="cont-cards-tiendas">
            <article class="card-tienda">
                <section class="cont-img">
                    <p>Cercano</p>
                    <label class="estrella-container">
                        <input type="checkbox" id="favorito">
                        <span class="estrella">★</span>
                    </label>
                    <img src="{{ asset('img/slider-1.jpg') }}" alt="Imagen de la tienda">
                </section>
                <section class="cont-info-tienda">
                    <h3>Nombre de la tienda</h3>
                    <p>Abierto</p>
                    <p>Carrera 50 #65-17, Manrique, Las Granjas</p>
                    <button type="submit">Ver tienda</button>
                </section>
            </article>
        </section>
    </main>

    <script>
    document.querySelectorAll('.toggle-favorito').forEach(checkbox => {
        const container = document.getElementById('favorite-stores');
        checkbox.addEventListener('change', function () {
            const storeId = this.dataset.storeId;
            const storeCard = document.getElementById(`store-${storeId}`);

            if (!this.checked) {
                fetch(`/store/${storeId}/unfavorite`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        storeCard.remove();
                    }
                    if (container.querySelectorAll('.card-tienda').length === 0) {
                            container.innerHTML = '<p class="mensaje-vacio">No tienes tiendaas favoritas todavía.</p>';
                    }
                })
                .catch(error => {
                    console.error("Error al quitar favorito:", error);
                });
            }
        });
    });
</script>


</x-app-layout>
 