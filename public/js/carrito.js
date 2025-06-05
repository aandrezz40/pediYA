document.addEventListener('DOMContentLoaded', () => {
    // ====== SELECCIÓN DE ELEMENTOS DEL DOM ======
    const contCarrito = document.getElementById('contCarrito');
    const abrirCarrito = document.getElementById('abrirCarrito');
    const cerrarCarrito = document.getElementById('cerrarCarrito');
    const overlayCarrito = document.getElementById('overlayCarrito');

    // ====== FUNCIONES PRINCIPALES ======
    document.querySelectorAll('.cont-cantidad-producto').forEach(form => {
        const confirmarBtn = form.querySelector('.btn-confirmar-cantidad');
        const aumentarBtn = form.querySelector('.aumentar-cantidad');
        const disminuirBtn = form.querySelector('.disminuir-cantidad');
        const cantidadSpan = form.querySelector('.cantidad-producto');
        let cantidad = parseInt(cantidadSpan.textContent) || 0;
        confirmarBtn.style.display = cantidad > 0 ? 'inline-block' : 'none';
    
        form.addEventListener('submit', e => {
            // Evitar que el formulario se envíe cuando se presionan + o -
            if (e.submitter === aumentarBtn || e.submitter === disminuirBtn) {
                e.preventDefault();
            }
        });
    
        aumentarBtn.addEventListener('click', e => {
            e.preventDefault();
            cantidad++;
            cantidadSpan.textContent = cantidad;
            confirmarBtn.style.display = cantidad > 0 ? 'inline-block' : 'none';
        });
    
        disminuirBtn.addEventListener('click', e => {
            e.preventDefault();
            if (cantidad > 0) {
                cantidad--;
                cantidadSpan.textContent = cantidad;
                confirmarBtn.style.display = cantidad > 0 ? 'inline-block' : 'none';
            }
        });
    });

    function abrirCarritoHandler() {
        if (!overlayCarrito || !contCarrito) return;

        overlayCarrito.classList.add('active-overlay-carrito');
        contCarrito.classList.add('visible-carrito');
        document.body.classList.add('no-scroll');
    }
    function cerrarCarritoHandler() {
        if (!overlayCarrito || !contCarrito) return;
        overlayCarrito.classList.remove('active-overlay-carrito');
        contCarrito.classList.remove('visible-carrito');
        document.body.classList.remove('no-scroll');
    }

    /**
     * Cierra todos los productos excepto el que se está abriendo
     * @param {HTMLElement} abrirProducto 
     */
    function cerrarOtrosProductos(abrirProducto) {
        document.querySelectorAll('.desplegarProducto').forEach((producto) => {
            if (producto !== abrirProducto) {
                const cardCarrito = producto.closest('.card-carrito');
                const contenido = producto.closest('.cont-acciones').nextElementSibling;

                producto.classList.remove('esconderProducto');
                contenido?.classList.add('oculto');
                cardCarrito?.classList.remove('con-altura-minima');
            }
        });
    }

    /**
     * Manejador del botón desplegar/ocultar producto
     * @param {HTMLElement} producto - El botón que se clickea
     */
    function toggleProductoHandler(producto) {
        const cardCarrito = producto.closest('.card-carrito');
        const contenido = producto.closest('.cont-acciones').nextElementSibling;

        if (!contenido) {
            console.warn('No se encontró .cont-productos relacionado.');
            return;
        }

        // Cerrar otros productos antes de abrir este
        cerrarOtrosProductos(producto);

        // Alternar clases
        producto.classList.toggle('esconderProducto');
        contenido.classList.toggle('oculto');

        // Ajustar altura mínima solo en la tarjeta actual
        if (producto.classList.contains('esconderProducto')) {
            cardCarrito.classList.add('con-altura-minima');
        } else {
            cardCarrito.classList.remove('con-altura-minima');
        }
    }

    // ====== EVENT LISTENERS ======

    if (abrirCarrito) {
        abrirCarrito.addEventListener('click', abrirCarritoHandler);
    }

    if (cerrarCarrito) {
        cerrarCarrito.addEventListener('click', cerrarCarritoHandler);
    }

    // Agregar evento click a cada botón de despliegue
    document.querySelectorAll('.desplegarProducto').forEach((producto) => {
        producto.addEventListener('click', () => toggleProductoHandler(producto));
    });

    // Opcional: Cerrar carrito al hacer click fuera
    if (overlayCarrito) {
        overlayCarrito.addEventListener('click', (e) => {
            if (e.target === overlayCarrito) {
                cerrarCarritoHandler();
            }
        });
    }

    console.log('✅ Carrito: Listo para usar.');
});
overlayCarrito.addEventListener('click', (e) => {
    if (e.target === overlayCarrito) {
        cerrarCarritoHandler();
    }
});