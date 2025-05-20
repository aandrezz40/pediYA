let contCarrito = document.getElementById('contCarrito');
let abrirCarrito = document.getElementById('abrirCarrito');
let cerrarCarrito = document.getElementById('cerrarCarrito');
let desplegarProducto = document.querySelectorAll('.desplegarProducto');
let contInfoProducto = document.querySelectorAll('.cont-productos');
let overlayCarrito = document.getElementById('overlayCarrito');

abrirCarrito.addEventListener('click', () => {
    overlayCarrito.classList.add('active-overlay-carrito');
    contCarrito.classList.add('visible-carrito');
});

cerrarCarrito.addEventListener('click', () => {
    overlayCarrito.classList.remove('active-overlay-carrito');
    contCarrito.classList.remove('visible-carrito');


});


desplegarProducto.forEach((producto, index) => {
    producto.addEventListener('click', () => {
        // Rotar la flecha
        producto.classList.toggle('esconderProducto');
        contInfoProducto[index].classList.toggle('oculto');
        // Ocultar/mostrar el contenido del producto
        
    });
});