// Elementos principales
const contProductosTienda = document.querySelector('.cont-productos-tienda');
const contDetallesTienda = document.querySelector('.cont-detalles-tienda');
const verProductos = document.getElementById('verProductos');
const verDetalles = document.getElementById('verDetalles');

// Token CSRF (se espera que esté definido en la vista)
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Función para cambiar entre secciones con animaciones
function mostrarSeccion(mostrar, ocultar) {
    ocultar.style.display = 'none';
    ocultar.classList.remove('animate__fadeInRight');

    mostrar.style.display = 'flex';
    void mostrar.offsetWidth; // Reinicia animación
    mostrar.classList.add('animate__animated', 'animate__fadeInRight');
}

// Eventos para mostrar secciones
verProductos.addEventListener('click', (e) => {
    e.preventDefault();
    mostrarSeccion(contProductosTienda, contDetallesTienda);
});
verDetalles.addEventListener('click', (e) => {
    e.preventDefault();
    mostrarSeccion(contDetallesTienda, contProductosTienda);
});

// Delegación de eventos para botones de categoría
document.addEventListener('click', function (e) {
    if (e.target.matches('.btn-categoria')) {
        e.preventDefault();

        // Activar solo este botón
        document.querySelectorAll('.btn-categoria').forEach(b => b.classList.remove('btn-categorias-activo'));
        e.target.classList.add('btn-categorias-activo');

        const categoryId = e.target.dataset.categoryId;
        const storeId = e.target.closest('[data-store-id]').dataset.storeId; // Asegúrate de poner data-store-id en el HTML

        fetch(`/product/${categoryId}/${storeId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            const productosContenedor = document.querySelector('.cont-cards-productos');
            productosContenedor.innerHTML = '';

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
                                    <form class="cont-cantidad-producto-detalles-tienda">
                                        <input type="submit" value="✔" class="btn-confirmar-cantidad-producto">
                                        <article class="cont-boton-cantidad-producto">
                                            <button type="button" class="disminuir-cantidad-producto">-</button>
                                            <span class="cantidad-producto-detalles-tienda">0</span>
                                            <button type="button" class="aumentar-cantidad-producto">+</button>
                                        </article>                                                
                                    </form>
                                </article>
                            </section>
                        </article>
                    `;
                });

                // Inicializar botones de cantidad en los nuevos productos
                initCantidadProductoHandlers();
            }
        })
        .catch(error => {
            console.error("Error al cargar productos:", error);
        });
    }
});
function initCantidadProductoHandlers() {
    const formularios = document.querySelectorAll('.form-agregar-producto');

    formularios.forEach((form) => {
        const spanCantidad = form.querySelector('.cantidad-producto-detalles-tienda');
        const btnIncrementar = form.querySelector('.aumentar-cantidad-producto');
        const btnDisminuir = form.querySelector('.disminuir-cantidad-producto');
        const inputCantidad = form.querySelector('.input-cantidad-producto');
        const btnConfirmar = form.querySelector('.btn-confirmar-cantidad-producto');

        let cantidad = parseInt(spanCantidad.textContent) || 0;

        const actualizarCantidad = () => {
            spanCantidad.textContent = cantidad;
            inputCantidad.value = cantidad;
            btnConfirmar.style.display = cantidad > 0 ? 'inline-block' : 'none';
        };

        // Inicializar visibilidad al cargar
        actualizarCantidad();

        btnIncrementar.addEventListener('click', () => {
            cantidad++;
            actualizarCantidad();
        });

        btnDisminuir.addEventListener('click', () => {
            if (cantidad > 0) {
                cantidad--;
                actualizarCantidad();
            }
        });
    });
}

// Ejecutar al cargar el DOM
document.addEventListener('DOMContentLoaded', initCantidadProductoHandlers);
