const btnCategoria = document.querySelectorAll('.btn-categoria');
const contProductosTienda = document.querySelector('.cont-productos-tienda');
const contDetallesTienda = document.querySelector('.cont-detalles-tienda');
const verProductos = document.getElementById('verProductos');
const verDetalles = document.getElementById('verDetalles');

btnCategoria.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        btn.classList.toggle('btn-categorias-activo');
    });
});

verProductos.addEventListener('click', () => {
    contProductosTienda.style.display = 'flex';
    contDetallesTienda.style.display = 'none';
});
verDetalles.addEventListener('click', () => {
    contProductosTienda.style.display = 'none';
    contDetallesTienda.style.display = 'flex';
});
