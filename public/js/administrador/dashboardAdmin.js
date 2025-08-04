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
    const storeId = fila.querySelector('.btn-info-tienda')?.getAttribute('data-store-id');

    // Limpia el contenedor de botones (excepto el botón "Ver")
    acciones.querySelectorAll('button:not(.btn-info-tienda)').forEach(btn => btn.remove());

    // Botón Activar/Desactivar según estado
    if (estado === 'Activa') {
        const btnDesactivar = crearBoton('Desactivar', 'btn-desactivar-tienda');
        btnDesactivar.setAttribute('data-store-id', storeId);
        btnDesactivar.addEventListener('click', () => desactivarTienda(storeId));
        acciones.appendChild(btnDesactivar);
    } else {
        const btnActivar = crearBoton('Activar', 'btn-activar-tienda');
        btnActivar.setAttribute('data-store-id', storeId);
        btnActivar.addEventListener('click', () => activarTienda(storeId));
        acciones.appendChild(btnActivar);
    }

    // Botón Aprobar/Desaprobar según aprobación
    if (aprobacion === 'Aprobada') {
        const btnDesaprobar = crearBoton('Desaprobar', 'btn-desaprobar-tienda');
        btnDesaprobar.setAttribute('data-store-id', storeId);
        btnDesaprobar.addEventListener('click', () => desaprobarTienda(storeId));
        acciones.appendChild(btnDesaprobar);
    } else if (aprobacion === 'Pendiente' || aprobacion === 'Rechazada') {
        const btnAprobar = crearBoton('Aprobar', 'btn-aprobar-tienda');
        btnAprobar.setAttribute('data-store-id', storeId);
        btnAprobar.addEventListener('click', () => aprobarTienda(storeId));
        acciones.appendChild(btnAprobar);
    }
});

// Lógica para mostrar botones de acción según estado y aprobación
document.querySelectorAll('.fila-tabla-gestion-usuarios').forEach(filaUsuario => {
    const estado = filaUsuario.querySelector('.estado-usuarios')?.textContent.trim();
    const acciones = filaUsuario.querySelector('.btns-acciones-gestion-usuarios-admin');
    const userId = filaUsuario.querySelector('.btn-info-usuarios')?.getAttribute('data-user-id');

    // Limpia el contenedor de botones (excepto el botón "Ver")
    acciones.querySelectorAll('button:not(.btn-info-usuarios)').forEach(btn => btn.remove());

    // Botón Activar/Desactivar según estado
    if (estado === 'Activo') {
        const btnDesactivar = crearBoton('Desactivar', 'btn-desactivar-usuarios');
        btnDesactivar.setAttribute('data-user-id', userId);
        btnDesactivar.addEventListener('click', () => desactivarUsuario(userId));
        acciones.appendChild(btnDesactivar);
    } else {
        const btnActivar = crearBoton('Activar', 'btn-activar-usuarios');
        btnActivar.setAttribute('data-user-id', userId);
        btnActivar.addEventListener('click', () => activarUsuario(userId));
        acciones.appendChild(btnActivar);
    }
});

// Función para crear botones
function crearBoton(texto, clase) {
    const btn = document.createElement('button');
    btn.className = clase;
    btn.textContent = texto;
    return btn;
}

// Variables para animaciones
const animation = 'animate__animated';
const nameAnimation1 = 'animate__fadeIn';
const nameAnimation2 = 'animate__fadeOut';

//FUNCIONES PARA NAVEGAR
const navDashboard = document.querySelector('.nav-section-dashboard');
const navTiendas = document.querySelector('.nav-section-tiendas');
const navUsuarios = document.querySelector('.nav-section-usuarios');

const contDashboard = document.querySelector('.section-principal-dashboard-admin');
const contTiendas = document.querySelector('.section-gestion-tienda-admin');
const contUsuarios = document.querySelector('.section-gestion-usuarios-admin');

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

// Función para cargar datos de tienda
async function cargarDatosTienda(storeId) {
    try {
        const response = await fetch(`/admin/tienda/${storeId}`);
        if (response.ok) {
            const store = await response.json();
            
            // Actualizar modal con datos de la tienda
            document.getElementById('modal-tienda-nombre').textContent = store.name;
            document.getElementById('modal-tienda-propietario').textContent = store.user?.name || 'N/A';
            document.getElementById('modal-tienda-telefono').textContent = store.user?.phone_number || 'N/A';
            document.getElementById('modal-tienda-email').textContent = store.user?.email || 'N/A';
            document.getElementById('modal-tienda-horario').textContent = store.schedule || 'No especificado';
            document.getElementById('modal-tienda-domicilio').textContent = store.offers_delivery ? 'Sí' : 'No';
            document.getElementById('modal-tienda-metodos-pago').textContent = store.payment_methods_formatted || 'No especificados';
            document.getElementById('modal-tienda-registro').textContent = new Date(store.created_at).toLocaleDateString('es-ES');
            document.getElementById('modal-tienda-actualizacion').textContent = new Date(store.updated_at).toLocaleDateString('es-ES');
            document.getElementById('modal-tienda-direccion').textContent = store.address_street || 'No especificada';
            document.getElementById('modal-tienda-barrio').textContent = store.address_neighborhood || 'No especificado';
            document.getElementById('modal-tienda-ciudad').textContent = 'Medellín';
            document.getElementById('modal-tienda-descripcion').textContent = store.description || 'Sin descripción';
            document.getElementById('modal-tienda-estado').textContent = store.is_active ? 'Activa' : 'Inactiva';
            document.getElementById('modal-tienda-apertura').textContent = store.is_open ? 'Abierta' : 'Cerrada';
            document.getElementById('modal-tienda-aprobacion').textContent = 
                store.status === 'approved' ? 'Aprobada' : 
                store.status === 'pending_approval' ? 'Pendiente' : 
                store.status === 'disapproved' ? 'Rechazada' : store.status;
            
            // Actualizar colores de estado
            const estadoElement = document.getElementById('modal-tienda-estado');
            const aperturaElement = document.getElementById('modal-tienda-apertura');
            const aprobacionElement = document.getElementById('modal-tienda-aprobacion');
            
            estadoElement.style.color = store.is_active ? '#2AA711' : 'red';
            aperturaElement.style.color = store.is_open ? '#2AA711' : 'red';
            aprobacionElement.style.color = store.status === 'approved' ? '#2AA711' : 
                                          store.status === 'pending_approval' ? 'orange' : 'red';
        }
    } catch (error) {
        console.error('Error al cargar datos de la tienda:', error);
    }
}

// Función para cargar datos de usuario
async function cargarDatosUsuario(userId) {
    try {
        const response = await fetch(`/admin/usuario/${userId}`);
        if (response.ok) {
            const user = await response.json();
            
            // Actualizar modal con datos del usuario
            document.getElementById('modal-usuario-nombre').textContent = `${user.name} - ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}`;
            document.getElementById('modal-usuario-nombre-completo').textContent = user.name;
            document.getElementById('modal-usuario-telefono').textContent = user.phone_number || 'N/A';
            document.getElementById('modal-usuario-email').textContent = user.email;
            document.getElementById('modal-usuario-estado').textContent = user.is_active ? 'Activo' : 'Inactivo';
            document.getElementById('modal-usuario-direccion').textContent = user.address?.address_street || 'No especificada';
            document.getElementById('modal-usuario-barrio').textContent = user.address?.address_neighborhood || 'No especificado';
            document.getElementById('modal-usuario-rol').textContent = user.role.charAt(0).toUpperCase() + user.role.slice(1);
            document.getElementById('modal-usuario-registro').textContent = new Date(user.created_at).toLocaleDateString('es-ES');
            document.getElementById('modal-usuario-verificacion').textContent = user.email_verified_at ? 'Verificado' : 'No verificado';
            document.getElementById('modal-usuario-tiendas').textContent = user.stores_count || 0;
            document.getElementById('modal-usuario-pedidos').textContent = user.orders_count || 0;
            document.getElementById('modal-usuario-ventas').textContent = user.total_sales ? `$${user.total_sales.toLocaleString()}` : '$0';
        }
    } catch (error) {
        console.error('Error al cargar datos del usuario:', error);
    }
}

// Funciones para gestión de tiendas
async function aprobarTienda(storeId) {
    if (!confirm('¿Estás seguro de que quieres aprobar esta tienda?')) return;
    
    try {
        const response = await fetch(`/admin/tienda/${storeId}/aprobar`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload(); // Recargar para actualizar la tabla
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error al aprobar tienda:', error);
        alert('Error al procesar la solicitud');
    }
}

async function desaprobarTienda(storeId) {
    if (!confirm('¿Estás seguro de que quieres desaprobar esta tienda?')) return;
    
    try {
        const response = await fetch(`/admin/tienda/${storeId}/desaprobar`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload(); // Recargar para actualizar la tabla
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error al desaprobar tienda:', error);
        alert('Error al procesar la solicitud');
    }
}

async function activarTienda(storeId) {
    if (!confirm('¿Estás seguro de que quieres activar esta tienda?')) return;
    
    try {
        const response = await fetch(`/admin/tienda/${storeId}/activar`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload(); // Recargar para actualizar la tabla
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error al activar tienda:', error);
        alert('Error al procesar la solicitud');
    }
}

async function desactivarTienda(storeId) {
    if (!confirm('¿Estás seguro de que quieres desactivar esta tienda?')) return;
    
    try {
        const response = await fetch(`/admin/tienda/${storeId}/desactivar`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload(); // Recargar para actualizar la tabla
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error al desactivar tienda:', error);
        alert('Error al procesar la solicitud');
    }
}

// Funciones para gestión de usuarios
async function activarUsuario(userId) {
    if (!confirm('¿Estás seguro de que quieres activar este usuario?')) return;
    
    try {
        const response = await fetch(`/admin/usuario/${userId}/activar`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload(); // Recargar para actualizar la tabla
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error al activar usuario:', error);
        alert('Error al procesar la solicitud');
    }
}

async function desactivarUsuario(userId) {
    if (!confirm('¿Estás seguro de que quieres desactivar este usuario?')) return;
    
    try {
        const response = await fetch(`/admin/usuario/${userId}/desactivar`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload(); // Recargar para actualizar la tabla
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error al desactivar usuario:', error);
        alert('Error al procesar la solicitud');
    }
}

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
        btn.addEventListener('click', function() {
            const storeId = this.getAttribute('data-store-id');
            if (storeId) {
                cargarDatosTienda(storeId);
            }
            abrirModal();
        });
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
        btn.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            if (userId) {
                cargarDatosUsuario(userId);
            }
            abrirModalUsuario();
        });
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