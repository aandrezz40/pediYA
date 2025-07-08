<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/tendero/homeTendero.css') }}">
    @endsection

    <main>
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
</x-app-layout>
 