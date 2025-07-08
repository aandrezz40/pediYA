// Sistema de notificaciones
class NotificationSystem {
    constructor() {
        this.notificationIcon = document.getElementById('notificacionIcon');
        this.notificationCount = document.getElementById('notificacionCount');
        this.notificationNumber = document.getElementById('notificacionNumber');
        this.notificationsContainer = null;
        
        this.init();
    }

    init() {
        this.loadUnreadCount();
        this.createNotificationsDropdown();
        this.setupEventListeners();
        
        // Actualizar cada 30 segundos
        setInterval(() => {
            this.loadUnreadCount();
        }, 30000);
    }

    createNotificationsDropdown() {
        // Crear el dropdown de notificaciones
        const dropdown = document.createElement('div');
        dropdown.className = 'notifications-dropdown';
        dropdown.id = 'notificationsDropdown';
        dropdown.style.cssText = `
            position: absolute;
            top: 100%;
            right: 0;
            width: 350px;
            max-height: 400px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            display: none;
            overflow-y: auto;
        `;

        const header = document.createElement('div');
        header.style.cssText = `
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        `;
        header.innerHTML = `
            <h3 style="margin: 0; font-size: 16px; font-weight: 600;">Notificaciones</h3>
            <button id="markAllRead" style="background: none; border: none; color: #007bff; cursor: pointer; font-size: 12px;">
                Marcar todas como leídas
            </button>
        `;

        const content = document.createElement('div');
        content.id = 'notificationsContent';
        content.style.cssText = `
            padding: 0;
        `;

        dropdown.appendChild(header);
        dropdown.appendChild(content);
        
        // Insertar después del icono de notificación
        this.notificationIcon.parentNode.insertBefore(dropdown, this.notificationIcon.nextSibling);
        this.notificationsContainer = dropdown;
    }

    setupEventListeners() {
        // Toggle dropdown al hacer clic en el icono
        this.notificationIcon.addEventListener('click', (e) => {
    e.stopPropagation();
            this.toggleDropdown();
        });

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!this.notificationsContainer.contains(e.target) && !this.notificationIcon.contains(e.target)) {
                this.hideDropdown();
            }
        });

        // Marcar todas como leídas
document.addEventListener('click', (e) => {
            if (e.target.id === 'markAllRead') {
                this.markAllAsRead();
            }
        });
    }

    async loadUnreadCount() {
        try {
            const response = await fetch('/notifications/unread-count');
            const data = await response.json();
            
            if (data.unread_count > 0) {
                this.notificationCount.style.display = 'block';
                this.notificationNumber.textContent = data.unread_count;
            } else {
                this.notificationCount.style.display = 'none';
            }
        } catch (error) {
            console.error('Error cargando notificaciones:', error);
        }
    }

    async loadNotifications() {
        try {
            const response = await fetch('/notifications');
            const data = await response.json();
            
            const content = document.getElementById('notificationsContent');
            
            if (data.notifications.data.length === 0) {
                content.innerHTML = `
                    <div style="padding: 20px; text-align: center; color: #666;">
                        No tienes notificaciones
                    </div>
                `;
                return;
            }

            content.innerHTML = data.notifications.data.map(notification => {
                const isRead = notification.read_at !== null;
                const timeAgo = this.getTimeAgo(notification.created_at);
                
                let message = '';
                if (notification.data.type === 'cambio_estado_pedido') {
                    message = `Tu pedido ${notification.data.order_code} cambió de estado`;
                } else if (notification.data.type === 'nuevo_pedido') {
                    message = `Nuevo pedido recibido de ${notification.data.customer_name}`;
                }

                return `
                    <div class="notification-item ${isRead ? 'read' : 'unread'}" 
                         data-id="${notification.id}"
                         style="padding: 15px; border-bottom: 1px solid #eee; cursor: pointer; ${!isRead ? 'background-color: #f8f9fa;' : ''}">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div style="flex: 1;">
                                <div style="font-weight: ${isRead ? '400' : '600'}; margin-bottom: 5px;">
                                    ${message}
                                </div>
                                <div style="font-size: 12px; color: #666;">
                                    ${timeAgo}
                                </div>
                            </div>
                            ${!isRead ? '<div style="width: 8px; height: 8px; background: #007bff; border-radius: 50%; margin-left: 10px;"></div>' : ''}
                        </div>
                    </div>
                `;
            }).join('');

            // Agregar event listeners a los items
            content.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', () => {
                    this.markAsRead(item.dataset.id);
                });
            });

        } catch (error) {
            console.error('Error cargando notificaciones:', error);
        }
    }

    async markAsRead(id) {
        try {
            const response = await fetch(`/notifications/${id}/read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            });
            
            if (response.ok) {
                this.loadUnreadCount();
                this.loadNotifications();
            }
        } catch (error) {
            console.error('Error marcando notificación como leída:', error);
        }
    }

    async markAllAsRead() {
        try {
            const response = await fetch('/notifications/mark-all-read', {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            });
            
            if (response.ok) {
                this.loadUnreadCount();
                this.loadNotifications();
            }
        } catch (error) {
            console.error('Error marcando todas las notificaciones como leídas:', error);
        }
    }

    toggleDropdown() {
        if (this.notificationsContainer.style.display === 'none' || !this.notificationsContainer.style.display) {
            this.showDropdown();
        } else {
            this.hideDropdown();
        }
    }

    showDropdown() {
        this.notificationsContainer.style.display = 'block';
        this.loadNotifications();
    }

    hideDropdown() {
        this.notificationsContainer.style.display = 'none';
    }

    getTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);

        if (diffInSeconds < 60) {
            return 'Hace un momento';
        } else if (diffInSeconds < 3600) {
            const minutes = Math.floor(diffInSeconds / 60);
            return `Hace ${minutes} minuto${minutes > 1 ? 's' : ''}`;
        } else if (diffInSeconds < 86400) {
            const hours = Math.floor(diffInSeconds / 3600);
            return `Hace ${hours} hora${hours > 1 ? 's' : ''}`;
        } else {
            const days = Math.floor(diffInSeconds / 86400);
            return `Hace ${days} día${days > 1 ? 's' : ''}`;
        }
    }
}

// Inicializar el sistema de notificaciones cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new NotificationSystem();
  });