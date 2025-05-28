<x-app-layout>
    <main>

        <!-- Sección de bienvenida -->
        <section class="cont-bienvenido">
            <article>
                <h2>¡Hola, {{ Auth::user()->name }}!</h2>
                <p>Explora todas nuestras tiendas disponibles.</p>
            </article>
            <article>
                <button type="submit" class="btn-buscarTiendas" onclick="location.href='#tituloTiendasCercanas'">Buscar</button>
            </article>
        </section>

        <!-- TIENDAS FAVORITAS -->
        <section class="titulo-contenedor" id="tituloTiendasFavoritas">
            <h2>Tiendas favoritas</h2>
        </section>
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
                <p class="mensaje-vacio">Aún no tienes tiendas favoritas. ¡Explora!</p>
            @endforelse
        </section>

        <!-- TIENDAS CERCANAS -->
        @php
            $favoriteStoreIds = $favoriteStores->pluck('id')->toArray();
        @endphp

        <section class="titulo-contenedor" id="tituloTiendasCercanas">
            <h2>Tiendas cercanas</h2>
        </section>
        <section id="stores-cerca" class="cont-cards-tiendas">
            @forelse ($stores as $store)
                <article id="store-{{ $store->id }}" class="card-tienda">
                    <section class="cont-img">
                        <p>Cercano</p>

                        {{-- Mostrar checkbox solo si la tienda NO está en favoritos --}}
                        @unless(in_array($store->id, $favoriteStoreIds))
                            <label class="estrella-container">
                                <input type="checkbox" class="toggle-favorito-cerca" data-store-id="{{ $store->id }}">
                                <span class="estrella">★</span>
                            </label>
                        @endunless

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
                <p class="mensaje-vacio">No hay tiendas cercanas disponibles en este momento.</p>
            @endforelse
        </section>
    </main>

<script>
    const csrfToken = '{{ csrf_token() }}';

    function createStoreCard(storeCardCerca, storeId) {
        const clonedCard = storeCardCerca.cloneNode(true);
        clonedCard.id = `favorite-store-${storeId}`;

        const checkbox = clonedCard.querySelector('input[type="checkbox"]');
        checkbox.classList.remove('toggle-favorito-cerca');
        checkbox.classList.add('toggle-favorito');
        checkbox.checked = true;
        checkbox.setAttribute('data-store-id', storeId);

        checkbox.addEventListener('change', () => handleRemoveFavorite(checkbox));

        const favContainer = document.getElementById('favorite-stores');
        const mensaje = favContainer.querySelector('.mensaje-vacio');
        if (mensaje) mensaje.remove();

        favContainer.appendChild(clonedCard);
    }

    function handleRemoveFavorite(checkbox) {
        const storeId = checkbox.dataset.storeId;
        const storeCard = checkbox.closest('.card-tienda');

        fetch(`/store/${storeId}/unfavorite`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                storeCard.remove();

                // Mostrar mensaje si no quedan favoritos
                const favContainer = document.getElementById('favorite-stores');
                if (favContainer.querySelectorAll('.card-tienda').length === 0) {
                    const mensaje = document.createElement('p');
                    mensaje.classList.add('mensaje-vacio');
                    mensaje.innerText = 'Aún no tienes tiendas favoritas. ¡Explora!';
                    favContainer.appendChild(mensaje);
                }

                // Reactivar checkbox en tiendas cercanas o crearlo si no existe
                const storeCardCerca = document.getElementById(`store-${storeId}`);
                if (storeCardCerca) {
                    let label = storeCardCerca.querySelector('.estrella-container');
                    if (!label) {
                        // Crear el label y checkbox si no existe (caso cuando fue eliminado)
                        label = document.createElement('label');
                        label.classList.add('estrella-container');

                        const checkboxCerca = document.createElement('input');
                        checkboxCerca.type = 'checkbox';
                        checkboxCerca.classList.add('toggle-favorito-cerca');
                        checkboxCerca.setAttribute('data-store-id', storeId);
                        checkboxCerca.checked = false;

                        // Listener para agregar favorito desde tiendas cercanas
                        checkboxCerca.addEventListener('change', () => {
                            if (checkboxCerca.checked) {
                                handleAddFavorite(checkboxCerca);
                            }
                        });

                        const span = document.createElement('span');
                        span.classList.add('estrella');
                        span.textContent = '★';

                        label.appendChild(checkboxCerca);
                        label.appendChild(span);

                        // Insertar el label dentro de la sección de imagen
                        const contImg = storeCardCerca.querySelector('.cont-img');
                        if (contImg) contImg.appendChild(label);
                    } else {
                        // Si el label ya existe pero estaba oculto o eliminado el checkbox, asegurarse que esté visible y desmarcado
                        const checkboxCerca = label.querySelector('input[type="checkbox"]');
                        if (checkboxCerca) {
                            checkboxCerca.checked = false;
                            checkboxCerca.style.display = 'inline-block';
                            label.style.display = 'inline-block';
                        }
                    }
                }
            }
        })
        .catch(error => console.error("Error al quitar favorito:", error));
    }

    function handleAddFavorite(checkbox) {
        const storeId = checkbox.dataset.storeId;
        const storeCardCerca = document.getElementById(`store-${storeId}`);

        fetch(`/store/${storeId}/favorite`, {
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
                createStoreCard(storeCardCerca, storeId);

                const label = storeCardCerca.querySelector('.estrella-container');
                if (label) label.remove();
            }
        })
        .catch(error => console.error("Error al agregar favorito:", error));
    }

    // Inicializar listeners
    document.querySelectorAll('.toggle-favorito').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (!checkbox.checked) handleRemoveFavorite(checkbox);
        });
    });

    document.querySelectorAll('.toggle-favorito-cerca').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) handleAddFavorite(checkbox);
            else handleRemoveFavorite(checkbox); // Opcional: quitar también desde "cercanas"
        });
    });
</script>

</x-app-layout>
