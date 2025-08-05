// Manejador de estado de tienda para el tendero
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si hay una alerta de estado de tienda
    const storeStatusAlert = document.querySelector('.store-status-alert');
    
    if (storeStatusAlert) {
        // Hacer que la alerta sea más prominente
        storeStatusAlert.style.position = 'fixed';
        storeStatusAlert.style.top = '20px';
        storeStatusAlert.style.left = '50%';
        storeStatusAlert.style.transform = 'translateX(-50%)';
        storeStatusAlert.style.zIndex = '10001';
        storeStatusAlert.style.minWidth = '400px';
        storeStatusAlert.style.maxWidth = '600px';
        
        // Agregar botón para cerrar la alerta
        const closeButton = document.createElement('button');
        closeButton.innerHTML = '&times;';
        closeButton.style.cssText = `
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            font-weight: bold;
        `;
        
        closeButton.addEventListener('click', function() {
            storeStatusAlert.style.display = 'none';
        });
        
        storeStatusAlert.appendChild(closeButton);
        
        // Auto-ocultar después de 10 segundos
        setTimeout(() => {
            if (storeStatusAlert.style.display !== 'none') {
                storeStatusAlert.style.opacity = '0';
                storeStatusAlert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    storeStatusAlert.style.display = 'none';
                }, 500);
            }
        }, 10000);
    }
    
    // Deshabilitar funcionalidades cuando la tienda no esté aprobada
    const isStoreApproved = document.querySelector('.btn-accion-tendero') !== null;
    
    if (!isStoreApproved) {
        // Deshabilitar modales y funcionalidades de productos
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.style.display = 'none';
        });
        
        // Mostrar mensaje informativo en la consola
        console.log('Tienda no aprobada - Funcionalidades deshabilitadas');
        
        // Agregar listener para prevenir acciones no permitidas
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-accion-tendero') || 
                e.target.closest('.btn-crear-categoria') || 
                e.target.closest('.btn-agregar-producto') ||
                e.target.closest('.btn-editar-producto') ||
                e.target.closest('.btn-eliminar-producto')) {
                
                // Verificar si el elemento está dentro de una sección deshabilitada
                const disabledSection = e.target.closest('.disabled-actions-message, .disabled-products-message');
                if (disabledSection) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Mostrar alerta temporal
                    showTemporaryAlert('Esta funcionalidad está deshabilitada debido al estado de tu tienda.', 'warning');
                }
            }
        });
    }
});

// Función para mostrar alertas temporales
function showTemporaryAlert(message, type = 'info') {
    const alert = document.createElement('div');
    alert.className = `temp-alert alert-${type}`;
    alert.innerHTML = `
        <strong>${type === 'warning' ? 'Advertencia:' : 'Información:'}</strong><br>
        ${message}
        <button class="close-temp-alert">&times;</button>
    `;
    
    alert.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 10002;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        max-width: 400px;
        word-wrap: break-word;
        background: ${type === 'warning' ? 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)' : 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)'};
        color: white;
        animation: slideInRight 0.5s ease-out;
    `;
    
    document.body.appendChild(alert);
    
    // Botón para cerrar
    const closeBtn = alert.querySelector('.close-temp-alert');
    closeBtn.style.cssText = `
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        font-weight: bold;
    `;
    
    closeBtn.addEventListener('click', () => {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            document.body.removeChild(alert);
        }, 500);
    });
    
    // Auto-ocultar después de 5 segundos
    setTimeout(() => {
        if (document.body.contains(alert)) {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                if (document.body.contains(alert)) {
                    document.body.removeChild(alert);
                }
            }, 500);
        }
    }, 5000);
}

// Animación para las alertas
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;
document.head.appendChild(style); 