// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    const icono_nav = document.getElementById('icono-nav-bar');
    const cont_nav = document.getElementById('cont-nav-bar');
    const close_nav = document.getElementById('close-nav-bar');
    const linkNav = document.querySelectorAll('.cont-icono');
    const contLinkNav = document.querySelectorAll('.container-links');

    // Verificar que los elementos existen antes de agregar event listeners
    if (icono_nav && cont_nav) {
        // Función para mostrar el menú
        icono_nav.addEventListener('click', () => {
            cont_nav.style.display = 'flex';
            cont_nav.offsetHeight;
            cont_nav.classList.add('visible');
        });
    }

    if (close_nav && cont_nav) {
        // Función para ocultar el menú
        close_nav.addEventListener('click', () => {
            cont_nav.classList.remove('visible');
            setTimeout(() => {
                cont_nav.style.display = 'none';
            }, 500); 
        });
    }

    //FUNCION PARA VERIFICAR A QUE LINK HACE REFERENCIA EL HOVER
    if (linkNav.length > 0 && contLinkNav.length > 0) {
        linkNav.forEach((link, index) => {
            if (contLinkNav[index]) {
                link.addEventListener('mouseover', () => {
                    contLinkNav[index].classList.add('activeContainerLinks');
                });
                link.addEventListener('mouseleave', () => {
                    contLinkNav[index].classList.remove('activeContainerLinks');
                });
            }
        });
    }

    //FUNCION PARA OCULTAR EL CONTENIDO DE LOS LINKS
    if (cont_nav) {
        cont_nav.addEventListener('click', (e) => {
            if (e.target === cont_nav) {
                cont_nav.classList.remove('visible');
                setTimeout(() => {
                    cont_nav.style.display = 'none';
                }, 500);
            }
        });
    }
});
