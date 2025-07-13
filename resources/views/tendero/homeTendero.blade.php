<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/tendero/homeTendero.css') }}">
    @endsection

    <main>
        <!-- Mensajes de sesión -->
        @if(session('success'))
            <div class="alert alert-success" style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: #28a745;
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                z-index: 10000;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                max-width: 300px;
                animation: slideInRight 0.5s ease-out;
            ">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: #dc3545;
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                z-index: 10000;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                max-width: 300px;
                animation: slideInRight 0.5s ease-out;
            ">
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning" style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: #ffc107;
                color: #212529;
                padding: 15px 20px;
                border-radius: 5px;
                z-index: 10000;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                max-width: 300px;
                animation: slideInRight 0.5s ease-out;
            ">
                {{ session('warning') }}
            </div>
        @endif

        <section class="cont-encabezado">
            <h2>Panel de Control</h2>
            <p>Bienvenido, {{ auth()->user()->name }}</p>
        </section>

        <section class="cont-cards">
            <div class="card-opcion">
                <div class="card-icon">
                    <img src="{{ asset('img/shopping-cart_.png') }}" alt="Pedidos">
                </div>
                <div class="card-content">
                    <h3>Gestión de Pedidos</h3>
                    <p>Administra los pedidos de tu tienda</p>
                    <a href="{{ route('tendero.pedidos') }}" class="btn-accion">Ver Pedidos</a>
                </div>
            </div>

            <div class="card-opcion">
                <div class="card-icon">
                    <img src="{{ asset('img/settings.svg') }}" alt="Configuración">
                </div>
                <div class="card-content">
                    <h3>Configuración</h3>
                    <p>Gestiona tu perfil y configuración</p>
                    <a href="{{ route('tendero.perfil') }}" class="btn-accion">Configurar</a>
                </div>
            </div>
        </section>
    </main>

    @section('scripts')
        <script>
            // Auto-ocultar mensajes de alerta después de 5 segundos
            document.addEventListener('DOMContentLoaded', function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.style.animation = 'slideOutRight 0.5s ease-out';
                        setTimeout(() => {
                            if (alert.parentNode) {
                                alert.parentNode.removeChild(alert);
                            }
                        }, 500);
                    }, 5000);
                });
            });

            // Agregar estilos CSS para las animaciones
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
                
                @keyframes slideOutRight {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        </script>
    @endsection
</x-app-layout>
 