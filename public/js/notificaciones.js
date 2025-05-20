const abrirContenedorNotificaciones = document.querySelector('.icono-notificacion-view');

const contenedorNotificaciones = document.querySelector('.contenedor-notificaciones');

abrirContenedorNotificaciones.addEventListener('click', (e) => {
    e.stopPropagation();
    contenedorNotificaciones.classList.toggle('contenedor-notificaciones-visible');
});
document.addEventListener('click', (e) => {
    if (!contenedorNotificaciones.contains(e.target) && !abrirContenedorNotificaciones.contains(e.target)) {
        contenedorNotificaciones.classList.remove('contenedor-notificaciones-visible');
    }
  });