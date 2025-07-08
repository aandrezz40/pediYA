// JavaScript para la gestión de pedidos del tendero

document.addEventListener('DOMContentLoaded', function() {
    // Filtros de estado
    const filtros = document.querySelectorAll('.filtro-btn');
    const cardsPedidos = document.querySelectorAll('.card-pedido');

    filtros.forEach(filtro => {
        filtro.addEventListener('click', function() {
            const estadoSeleccionado = this.dataset.estado;
            
            // Actualizar botón activo
            filtros.forEach(f => f.classList.remove('active'));
            this.classList.add('active');
            
            // Filtrar pedidos
            filtrarPedidos(estadoSeleccionado);
        });
    });

    function filtrarPedidos(estado) {
        cardsPedidos.forEach(card => {
            if (estado === 'todos' || card.dataset.estado === estado) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Cambio de estado de pedidos
    const selectoresEstado = document.querySelectorAll('.estado-selector');
    
    selectoresEstado.forEach(selector => {
        selector.addEventListener('change', function() {
            const nuevoEstado = this.value;
            const orderId = this.dataset.orderId;
            
            if (!nuevoEstado) return;
            
            cambiarEstadoPedido(orderId, nuevoEstado, this);
        });
    });

    async function cambiarEstadoPedido(orderId, nuevoEstado, selector) {
        try {
            const response = await fetch(`/tendero/pedido/${orderId}/estado`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    nuevo_estado: nuevoEstado
                })
            });

            const data = await response.json();

            if (response.ok) {
                // Mostrar mensaje de éxito
                mostrarNotificacion('Estado actualizado correctamente', 'success');
                
                // Actualizar la interfaz
                actualizarInterfazPedido(orderId, nuevoEstado, selector);
                
                // Recargar la página después de un breve delay para mostrar los cambios
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                mostrarNotificacion(data.error || 'Error al actualizar el estado', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarNotificacion('Error de conexión', 'error');
        }
    }

    function actualizarInterfazPedido(orderId, nuevoEstado, selector) {
        const card = selector.closest('.card-pedido');
        const estadoBadge = card.querySelector('.estado-badge');
        
        // Actualizar el badge de estado
        estadoBadge.className = `estado-badge estado-${nuevoEstado}`;
        estadoBadge.textContent = obtenerTextoEstado(nuevoEstado);
        
        // Actualizar el data attribute
        card.dataset.estado = nuevoEstado;
        
        // Deshabilitar el selector temporalmente
        selector.disabled = true;
        selector.style.opacity = '0.5';
    }

    function obtenerTextoEstado(estado) {
        const estados = {
            'pending': 'Pendiente',
            'confirmed': 'Confirmado',
            'preparing': 'En preparación',
            'ready': 'Listo',
            'delivered': 'Entregado',
            'cancelled': 'Cancelado'
        };
        return estados[estado] || estado;
    }

    function mostrarNotificacion(mensaje, tipo) {
        // Crear elemento de notificación
        const notificacion = document.createElement('div');
        notificacion.className = `notificacion notificacion-${tipo}`;
        notificacion.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: 300px;
        `;
        
        // Estilos según el tipo
        if (tipo === 'success') {
            notificacion.style.background = '#10b981';
        } else if (tipo === 'error') {
            notificacion.style.background = '#ef4444';
        }
        
        notificacion.textContent = mensaje;
        
        // Agregar al DOM
        document.body.appendChild(notificacion);
        
        // Animar entrada
        setTimeout(() => {
            notificacion.style.transform = 'translateX(0)';
        }, 100);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            notificacion.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notificacion);
            }, 300);
        }, 3000);
    }

    // Contador de pedidos por estado
    function actualizarContadores() {
        const estados = ['pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled'];
        const contadores = {};
        
        estados.forEach(estado => {
            contadores[estado] = document.querySelectorAll(`[data-estado="${estado}"]`).length;
        });
        
        // Actualizar texto de los filtros con contadores
        filtros.forEach(filtro => {
            const estado = filtro.dataset.estado;
            if (estado !== 'todos') {
                const contador = contadores[estado];
                const textoOriginal = filtro.textContent.split('(')[0].trim();
                filtro.textContent = `${textoOriginal} (${contador})`;
            }
        });
    }

    // Ejecutar contadores al cargar
    actualizarContadores();
}); 