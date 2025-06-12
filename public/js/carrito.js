document.addEventListener('DOMContentLoaded', () => {
    const contCarrito      = document.getElementById('contCarrito');
    const abrirCarrito     = document.getElementById('abrirCarrito');
    const cerrarCarrito    = document.getElementById('cerrarCarrito');
    const overlayCarrito   = document.getElementById('overlayCarrito');

    // —————— Función para resetear todos los acordiones ——————
    function resetAcordiones() {
        // Quitar altura mínima de todas las tarjetas
        document.querySelectorAll('.card-carrito').forEach(card => {
            card.classList.remove('con-altura-minima');
        });
        // Ocultar todos los contenidos
        document.querySelectorAll('.cont-productos').forEach(contenido => {
            contenido.classList.add('oculto');
        });
        // Rotación a su estado original de todos los botones
        document.querySelectorAll('.desplegarProducto').forEach(btn => {
            btn.classList.remove('esconderProducto');
        });
    }

    function abrirCarritoHandler() {
        if (!overlayCarrito || !contCarrito) return;
        // Resetear acordiones ANTES de mostrar el carrito
        resetAcordiones();
        overlayCarrito.classList.add('active-overlay-carrito');
        contCarrito.classList.add('visible-carrito');
        document.body.classList.add('no-scroll');
    }

    function cerrarCarritoHandler() {
        if (!overlayCarrito || !contCarrito) return;
        overlayCarrito.classList.remove('active-overlay-carrito');
        contCarrito.classList.remove('visible-carrito');
        document.body.classList.remove('no-scroll');
        // Resetear acordiones DESPUÉS de ocultar el carrito
        resetAcordiones();
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

    // —————— Event Listeners ——————
    abrirCarrito?.addEventListener('click', abrirCarritoHandler);
    cerrarCarrito?.addEventListener('click', cerrarCarritoHandler);

    document.querySelectorAll('.desplegarProducto')
        .forEach(btn => btn.addEventListener('click', () => toggleProductoHandler(btn)));

    overlayCarrito?.addEventListener('click', e => {
        if (e.target === overlayCarrito) cerrarCarritoHandler();
    });
    // Opcional: Cerrar carrito al hacer click fuera

    // ====== FUNCIONES PRINCIPALES ======
    document.querySelectorAll('.cont-cantidad-producto').forEach(form => {
        const confirmarBtn = form.querySelector('.btn-confirmar-cantidad');
        const aumentarBtn = form.querySelector('.aumentar-cantidad');
        const disminuirBtn = form.querySelector('.disminuir-cantidad');
        const cantidadSpan = form.querySelector('.cantidad-producto');
        let cantidadActual = parseInt(cantidadSpan.textContent) || 0;
        
        let cantidad = parseInt(cantidadSpan.textContent) || 0;
        confirmarBtn.style.display = cantidad > 0 && cantidad != cantidadActual ? 'inline-block' : 'none';
    
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
    console.log('✅ Carrito: Listo para usar.');
});
