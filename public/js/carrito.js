// Función para mostrar mensajes
function mostrarMensaje(texto, error = false) {
    // Crear elemento de mensaje si no existe
    let mensaje = document.getElementById('mensaje-flotante');
    if (!mensaje) {
        mensaje = document.createElement('div');
        mensaje.id = 'mensaje-flotante';
        mensaje.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            z-index: 10000;
            display: none;
            max-width: 300px;
            word-wrap: break-word;
        `;
        document.body.appendChild(mensaje);
    }
    
    mensaje.innerText = texto;
    mensaje.style.background = error ? '#dc3545' : '#62238D';
    mensaje.style.display = 'block';
    
    setTimeout(() => {
        mensaje.style.display = 'none';
    }, 2500);
}

function inicializarEventosCarrito() {
    const contCarrito      = document.getElementById('contCarrito');
    const cerrarCarrito    = document.getElementById('cerrarCarrito');
    const overlayCarrito   = document.getElementById('overlayCarrito');

    function resetAcordiones() {
        document.querySelectorAll('.card-carrito').forEach(card => {
            card.classList.remove('con-altura-minima');
        });
        document.querySelectorAll('.cont-productos').forEach(contenido => {
            contenido.classList.add('oculto');
        });
        document.querySelectorAll('.desplegarProducto').forEach(btn => {
            btn.classList.remove('esconderProducto');
        });
    }

    function cerrarOtrosProductos(abrirProducto) {
        document.querySelectorAll('.desplegarProducto').forEach((producto) => {
            if (producto !== abrirProducto) {
                const cardCarrito = producto.closest('.card-carrito');
                const contenido   = producto.closest('.cont-acciones').nextElementSibling;
                producto.classList.remove('esconderProducto');
                contenido?.classList.add('oculto');
                cardCarrito?.classList.remove('con-altura-minima');
            }
        });
    }

    function toggleProductoHandler(producto) {
        const cardCarrito = producto.closest('.card-carrito');
        const contenido   = producto.closest('.cont-acciones').nextElementSibling;
        if (!contenido) return console.warn('No se encontró .cont-productos.');

        cerrarOtrosProductos(producto);

        producto.classList.toggle('esconderProducto');
        contenido.classList.toggle('oculto');

        if (producto.classList.contains('esconderProducto')) {
            cardCarrito.classList.add('con-altura-minima');
        } else {
            cardCarrito.classList.remove('con-altura-minima');
        }
    }

    cerrarCarrito?.addEventListener('click', () => {
        overlayCarrito?.classList.remove('active-overlay-carrito');
        contCarrito?.classList.remove('visible-carrito');
        document.body.classList.remove('no-scroll');
        resetAcordiones();
    });

    overlayCarrito?.addEventListener('click', e => {
        if (e.target === overlayCarrito) {
            overlayCarrito.classList.remove('active-overlay-carrito');
            contCarrito?.classList.remove('visible-carrito');
            document.body.classList.remove('no-scroll');
            resetAcordiones();
        }
    });

    document.querySelectorAll('.desplegarProducto')
        .forEach(btn => btn.addEventListener('click', () => toggleProductoHandler(btn)));

    document.querySelectorAll('.cont-cantidad-producto').forEach(form => {
        const confirmarBtn = form.querySelector('.btn-confirmar-cantidad');
        const aumentarBtn = form.querySelector('.aumentar-cantidad');
        const disminuirBtn = form.querySelector('.disminuir-cantidad');
        const cantidadSpan = form.querySelector('.cantidad-producto');
        let cantidadActual = parseInt(cantidadSpan.textContent) || 0;

        let cantidad = parseInt(cantidadSpan.textContent) || 0;
        confirmarBtn.style.display = cantidad > 0 && cantidad != cantidadActual ? 'inline-block' : 'none';

        form.addEventListener('submit', e => {
            if (e.submitter === aumentarBtn || e.submitter === disminuirBtn) {
                e.preventDefault();
            }
        });

        aumentarBtn.addEventListener('click', e => {
            e.preventDefault();
            cantidad++;
            cantidadSpan.textContent = cantidad;
            confirmarBtn.style.display = cantidad > 0 && cantidad != cantidadActual ? 'inline-block' : 'none';
        });

        disminuirBtn.addEventListener('click', e => {
            e.preventDefault();
            if (cantidad > 0) {
                cantidad--;
                cantidadSpan.textContent = cantidad;
                confirmarBtn.style.display = cantidad > 0 && cantidad != cantidadActual ? 'inline-block' : 'none';
            }
        });
    });

    console.log('✅ Carrito: Eventos asignados');

    document.querySelectorAll('.eliminarOrden').forEach(btn => {
    btn.addEventListener('click', () => {
        const card = btn.closest('.card-carrito');
        const orderId = card.dataset.orderId;

        if (!orderId) return;

        if (!confirm('¿Estás seguro de eliminar esta orden completa?')) return;

        fetch(`/cliente/pedido/eliminar/${orderId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.mensaje) {
                mostrarMensaje(data.mensaje);
                card.remove(); // Elimina el HTML del carrito
                
                // Actualizar contador del carrito
                const contadorCarrito = document.getElementById('contadorCarrito');
                const spanContador = contadorCarrito.querySelector('span');
                const totalTexto = document.querySelector('.cont-total p');
                
                // Reducir el contador en 1
                const contadorActual = parseInt(spanContador.textContent) || 0;
                const nuevoContador = Math.max(0, contadorActual - 1);
                spanContador.textContent = nuevoContador;
                
                // Ocultar contador si no hay órdenes
                if (nuevoContador === 0) {
                    contadorCarrito.classList.add('hidden');
                }
                
                // Verificar si no quedan órdenes en el carrito
                const ordenesRestantes = document.querySelectorAll('.card-carrito');
                if (ordenesRestantes.length === 0) {
                    const contenedor = document.getElementById('contenedorCarritoInterno');
                    contenedor.innerHTML = '<p class="mensaje-vacio">No hay productos en el carrito</p>';
                    
                    // Actualizar total a 0
                    if (totalTexto) {
                        totalTexto.innerHTML = '$0';
                    }
                }
            }
        })
        .catch(error => {
            console.error(error);
            mostrarMensaje('Error al eliminar la orden', true);
        });
    });
    });

            document.querySelectorAll('.btn-confirmar-cantidad').forEach(button => {
        button.addEventListener('click', async function () {
            const form = this.closest('form');
            const itemId = form.dataset.id;
            const quantitySpan = form.querySelector('.cantidad-producto');
            const quantityInput = form.querySelector('input[name="quantity"]');

            const quantity = parseInt(quantitySpan.textContent.trim());
            quantityInput.value = quantity; // Actualiza input oculto

            try {
                const response = await fetch(`/actualizar-cantidad/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity })
                });

                const data = await response.json();

            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
}


// Función global para actualizar contador del carrito
window.actualizarContadorCarrito = function(nuevoContador) {
    const contadorCarrito = document.getElementById('contadorCarrito');
    const spanContador = contadorCarrito.querySelector('span');
    
    if (spanContador) {
        spanContador.textContent = nuevoContador;
        
        if (nuevoContador > 0) {
            contadorCarrito.classList.remove('hidden');
        } else {
            contadorCarrito.classList.add('hidden');
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const abrirCarrito = document.getElementById('abrirCarrito');
    const contCarrito  = document.getElementById('contCarrito');
    const overlayCarrito = document.getElementById('overlayCarrito');

    function abrirCarritoHandler() {
        if (!overlayCarrito || !contCarrito) return;
        overlayCarrito.classList.add('active-overlay-carrito');
        contCarrito.classList.add('visible-carrito');
        document.body.classList.add('no-scroll');
    }

    abrirCarrito?.addEventListener('click', abrirCarritoHandler);

    inicializarEventosCarrito(); // Primera vez
});