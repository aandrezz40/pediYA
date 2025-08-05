// Cambia el color de los estados y aprobaciones
document.querySelectorAll('.estado-tienda').forEach(estado => {
    estado.style.color = (estado.textContent.trim() === 'Activa') ? '#2AA711' : 'red';
});
document.querySelectorAll('.aprobacion-tienda').forEach(aprobacion => {
    aprobacion.style.color = (aprobacion.textContent.trim() === 'Aprobada') ? '#2AA711' : 'orange';
});
document.querySelectorAll('.estado-usuarios').forEach(estadoUsuarios => {
    estadoUsuarios.style.color = (estadoUsuarios.textContent.trim() === 'Activo') ? '#2AA711' : 'red';
});

// Lógica para mostrar botones de acción según estado y aprobación
document.querySelectorAll('.fila-tabla-gestion-tienda').forEach(fila => {
    const estado = fila.querySelector('.estado-tienda')?.textContent.trim();
    const aprobacion = fila.querySelector('.aprobacion-tienda')?.textContent.trim();
    const acciones = fila.querySelector('.btns-acciones-gestion-tienda-admin');

    // Limpia el contenedor de botones (excepto el botón "Ver")
    acciones.querySelectorAll('button:not(.btn-info-tienda)').forEach(btn => btn.remove());

    // Botón Activar/Desactivar según estado
    if (estado === 'Activa') {
        acciones.appendChild(crearBoton('Desactivar', 'btn-desactivar-tienda-admin'));
    } else {
        acciones.appendChild(crearBoton('Actsivar', 'btn-activar-tienda'));
    }

    // Botón Aprobar/Desaprobar según aprobación
    if (aprobacion === 'Aprobada') {
        acciones.appendChild(crearBoton('Desaprobar', 'btn-desaprobar-tienda'));
    } else {
        acciones.appendChild(crearBoton('Aprobar', 'btn-aprobar-tienda'));
    }
});

// Lógica para mostrar botones de acción según estado y aprobación
document.querySelectorAll('.fila-tabla-gestion-usuarios').forEach(filaUsuario => {
    const estado = filaUsuario.querySelector('.estado-usuarios')?.textContent.trim();
    const acciones = filaUsuario.querySelector('.btns-acciones-gestion-usuarios-admin');

    // Limpia el contenedor de botones (excepto el botón "Ver")
    acciones.querySelectorAll('button:not(.btn-info-usuarios)').forEach(btn => btn.remove());

    // Botón Activar/Desactivar según estado
    if (estado === 'Activo') {
        acciones.appendChild(crearBoton('Desactivar', 'btn-desactivar-usuarios'));
    } else {
        acciones.appendChild(crearBoton('Activar', 'btn-activar-usuarios'));
    }
});

// Función para crear botones
function crearBoton(texto, clase) {
    const btn = document.createElement('button');
    btn.className = clase;
    btn.textContent = texto;
    return btn;
}

//FUNCIONES PARA NAVEGAR
const navDashboard = document.querySelector('.nav-section-dashboard');
const navTiendas = document.querySelector('.nav-section-tiendas');
const navUsuarios = document.querySelector('.nav-section-usuarios');

const contDashboard = document.querySelector('.section-principal-dashboard-admin');
const contTiendas = document.querySelector('.section-gestion-tienda-admin');
const contUsuarios = document.querySelector('.section-gestion-usuarios-admin');

const animation = 'animate__animated';
const nameAnimation1 = 'animate__fadeIn';
const nameAnimation2 = 'animate__fadeOut';

if(navDashboard){
    navDashboard.addEventListener('click', function () {
        contTiendas.style.display = 'none';
        contUsuarios.style.display = 'none';
        contDashboard.classList.add(animation, nameAnimation1)
        contDashboard.style.display = 'flex';
    });
}else{
    console.log('Elemento no encontrado en el DOM');
};

if(navTiendas){
    navTiendas.addEventListener('click', function () {
        contDashboard.style.display = 'none';
        contUsuarios.style.display = 'none';
        contTiendas.classList.add(animation, nameAnimation1)
        contTiendas.style.display = 'flex';

    });
}else{
    console.log('Elemento no encontrado en el DOM');
};

if(navUsuarios){
    navUsuarios.addEventListener('click', function () {
        contUsuarios.classList.add(animation, nameAnimation1)
        contDashboard.style.display = 'none';
        contTiendas.style.display = 'none';
        contUsuarios.style.display = 'flex';
    });
}else{
    console.log('Elemento no encontrado en el DOM');
};

//FUNCIONES DEL MODAL DE DETALLES TIENDA
const estadoDetalleTiendaAdmin = document.querySelector('.estado-detalles-tienda-admin');
const aprobacionDetalleTiendaAdmin = document.querySelector('.aprobacion-detalles-tienda-admin');
const cerrarDetallesTiendaAdmin = document.querySelector('.cerrar-modal-tienda-info-admin');
const contDetallesTiendaAdmin = document.querySelector('.overlay-section-detalle-tienda-admin');
const abrirModalTiendaAdmin = document.querySelectorAll('.btn-info-tienda');

// Función para abrir el modal con animación de entrada
function abrirModal() {
    contDetallesTiendaAdmin.classList.remove(animation, nameAnimation2);
    contDetallesTiendaAdmin.classList.add(animation, nameAnimation1);
    contDetallesTiendaAdmin.style.display = 'flex';
}

// Función para cerrar el modal con animación de salida
function cerrarModal() {
    contDetallesTiendaAdmin.classList.remove(animation, nameAnimation1);
    contDetallesTiendaAdmin.classList.add(animation, nameAnimation2);
    
    // Esperar a que termine la animación de salida antes de ocultar
    setTimeout(() => {
        contDetallesTiendaAdmin.style.display = 'none';
        contDetallesTiendaAdmin.classList.remove(animation, nameAnimation2);
    }, 300); // 500ms es la duración típica de animate.css
}

if(abrirModalTiendaAdmin){
    abrirModalTiendaAdmin.forEach(btn => {
        btn.addEventListener('click', abrirModal);
    });
}else{
    console.log('Elementos no encontrados en el DOM');
};

if(estadoDetalleTiendaAdmin){
    if(estadoDetalleTiendaAdmin.textContent.trim() == 'Activa'){
        estadoDetalleTiendaAdmin.style.color = 'green';
    }else{
        estadoDetalleTiendaAdmin.style.color = 'red';
    }
}else{
    console.log('Elemento no encontrado en el DOM');
};

if(aprobacionDetalleTiendaAdmin){
    if(aprobacionDetalleTiendaAdmin.textContent.trim() == 'Aprobada'){
        aprobacionDetalleTiendaAdmin.style.color = 'green';
    }else{
        aprobacionDetalleTiendaAdmin.style.color = 'red';
    }
}else{
    console.log('Elemento no encontrado en el DOM');
};

if(cerrarDetallesTiendaAdmin){
    cerrarDetallesTiendaAdmin.addEventListener('click', cerrarModal);
}else{
    console.log('Elemento no encontrado en el DOM');
};

// Función para cerrar el modal de la tienda si da clic fuera de este
if (contDetallesTiendaAdmin) {
    contDetallesTiendaAdmin.addEventListener('click', function (e) {
        // Si el click es en el overlay (no en el contenido del modal)
        if (e.target === contDetallesTiendaAdmin) {
            cerrarModal();
        }
    });
}

//FUNCIONES DEL MODAL DE DETALLES USUARIOS

const cerrarDetallesUsuarioAdmin = document.querySelector('.cerrar-modal-usuario-info-admin');
const contDetallesUsuarioAdmin = document.querySelector('.overlay-section-detalle-usuario-admin');
const abrirModalUsuarioAdmin = document.querySelectorAll('.btn-info-usuarios');

// Función para abrir el modal con animación de entrada
function abrirModalUsuario() {
    contDetallesUsuarioAdmin.classList.remove(animation, nameAnimation2);
    contDetallesUsuarioAdmin.classList.add(animation, nameAnimation1);
    contDetallesUsuarioAdmin.style.display = 'flex';
}

// Función para cerrar el modal con animación de salida
function cerrarModalUsuario() {
    contDetallesUsuarioAdmin.classList.remove(animation, nameAnimation1);
    contDetallesUsuarioAdmin.classList.add(animation, nameAnimation2);
    
    // Esperar a que termine la animación de salida antes de ocultar
    setTimeout(() => {
        contDetallesUsuarioAdmin.style.display = 'none';
        contDetallesUsuarioAdmin.classList.remove(animation, nameAnimation2);
    }, 300); // 500ms es la duración típica de animate.css
}

if(abrirModalUsuarioAdmin){
    abrirModalUsuarioAdmin.forEach(btn => {
        btn.addEventListener('click', abrirModalUsuario);
    });
}else{
    console.log('Elementos no encontrados en el DOM');
};

if(cerrarDetallesUsuarioAdmin){
    cerrarDetallesUsuarioAdmin.addEventListener('click', cerrarModalUsuario);
}else{
    console.log('Elemento no encontrado en el DOM');
};

// Función para cerrar el modal de la tienda si da clic fuera de este
if (contDetallesUsuarioAdmin) {
    contDetallesUsuarioAdmin.addEventListener('click', function (e) {
        // Si el click es en el overlay (no en el contenido del modal)
        if (e.target === contDetallesUsuarioAdmin) {
            cerrarModalUsuario();
        }
    });
}