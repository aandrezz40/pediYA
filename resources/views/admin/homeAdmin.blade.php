<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
        @section('styles')
        <link rel="stylesheet" href="{{ asset('css/administrador/dashboardAdmin.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @endsection
    <section class="container-body-dashboard-admin">
        <aside class="nav-bar-lateral-dashboard">
            <h2 class="nombre-empresa-dashboard-admin">PediYÁ</h2>
            <ul class="list-opciones-nav-bar-admin">
                <li class="opcion-nav-bar-admin nav-section-dashboard">
                    <img src="{{ asset('img/dashboard.svg') }}" alt="">
                    <p>Dashboard</p>
                </li>
                <li class="opcion-nav-bar-admin nav-section-tiendas">
                    <img src="{{ asset('img/logo-v1.1.png') }}" alt="">
                    <p>Tienda</p>
                </li>
                <li class="opcion-nav-bar-admin nav-section-usuarios">
                    <img src="{{ asset('img/users.svg') }}" alt="">
                    <p>Usuarios</p>
                </li>
            </ul>
            <article class="container-cerrar-sesion">
                <p>{{ auth()->user()->name }}</p>
                <p>Administrador</p>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </article>
        </aside>
        <main class="main-dashboard-admin">
            <section class="section-principal-dashboard-admin">
                <h2 class="titulo-section-dashboard-admin">Panel administrativo</h2>
                <article class="container-opciones-dashboard">
                    <section class="opcion-dashboard">
                        <img src="{{ asset('img/logo-v1.1.png') }}" alt="">
                        <h3>Tiendas</h3>
                        <p>Administra y gestiona todas las tiendas registradas en la plataforma</p>
                    </section>
                    <section class="opcion-dashboard">
                        <img src="{{ asset('img/users.svg') }}" alt="">
                        <h3>Usuarios</h3>
                        <p>Gestión de usuarios - Clientes y Tenderos de la plataforma</p>
                    </section>
                </article>
            </section>
            <section class="section-gestion-tienda-admin">
                <h2 class="titulo-section-gestion-tienda-admin">Gestión de Tiendas</h2>
                <p class="enunciado-section">Administra todas las tiendas de barrio registradas</p>
                <article class="container-table-tiendas-admin">
                    <h2 class="titulo-tabla-admin">Listado de tiendas</h2>
                    <table class="tabla-tiendas-admin">
                        <thead>
                            <th>Nombre de la tienda</th>
                            <th>Propietario</th>
                            <th>Estado</th>
                            <th>Aprobación</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @forelse($stores as $store)
                            <tr class="fila-tabla-gestion-tienda">
                                <td class="nombre-tienda">{{ $store->name }}</td>
                                <td>{{ $store->user->name ?? 'N/A' }}</td>
                                <td class="estado-tienda">{{ $store->is_active ? 'Activa' : 'Inactiva' }}</td>
                                <td class="aprobacion-tienda">
                                    @switch($store->status)
                                        @case('approved')
                                            Aprobada
                                            @break
                                        @case('pending_approval')
                                            Pendiente
                                            @break
                                        @case('disapproved')
                                            Rechazada
                                            @break
                                        @default
                                            {{ ucfirst($store->status) }}
                                    @endswitch
                                </td>
                                <td class="btns-acciones-gestion-tienda-admin">
                                    <button class="btn-info-tienda" data-store-id="{{ $store->id }}">Ver</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px;">No hay tiendas registradas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </article>
            </section>
            <!--DISEÑO MODAL DE LA TIENDA-->
            <section class="overlay-section-detalle-tienda-admin">
                <article class="cont-detalles-tienda-admin">
                    <section class="encabezado-info-tienda-admin">
                        <article class="cont-titulo-encabezado">
                            <h2 class="titulo-encabeado" id="modal-tienda-nombre">Nombre de la tienda</h2>
                            <p>Información completa del establecimiento</p>
                        </article>
                        <img src="{{ asset('img/x-fill-12_.png') }}" alt="" class="cerrar-modal-tienda-info-admin">
                    </section>
                    <section class="cont-info-tienda-admin">
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Información básica</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Propietario: <span id="modal-tienda-propietario">Nombre de la persona</span></p>
                                <p>Teléfono: <span id="modal-tienda-telefono">xxx-xxx-xxxx</span></p>
                                <p>Email: <span id="modal-tienda-email">sergio@gmail.com</span></p>
                            </section>
                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Operación</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Horario: <span id="modal-tienda-horario">Lunes a Domingo: 6:00 A.M - 10:00 P.M</span></p>
                                <p>Domicilio: <span id="modal-tienda-domicilio">Si</span></p>
                            </section>
                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Métodos de pago</h2>
                            <section class="descripcion-card-tienda-admin" id="modal-tienda-metodos-pago">
                                Efectivo, Nequi, Bancolombia
                            </section>
                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Fechas</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Registro: <span id="modal-tienda-registro">15/01/2025</span></p>
                                <p>Ultima actualización: <span id="modal-tienda-actualizacion">28/05/2026</span></p>
                            </section>
                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Ubicación</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Dirección: <span id="modal-tienda-direccion">Calle 45 #23-12</span></p>
                                <p>Barrio: <span id="modal-tienda-barrio">Barrio Centro</span></p>
                                <p>Ciudad: <span id="modal-tienda-ciudad">Medellín</span></p>
                            </section>
                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Descripción</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p><span id="modal-tienda-descripcion">Tienda de barrio con productos básicos y abarrotes</span></p>
                            </section>
                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Estado actual</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Activación: <span class="estado-detalles-tienda-admin" id="modal-tienda-estado">Activa</span></p>
                                <p>Apertura: <span class="estado-apertura-tienda-admin" id="modal-tienda-apertura">Abierta</span></p>
                                <p>Aprobación: <span class="aprobacion-detalles-tienda-admin" id="modal-tienda-aprobacion">Aprobada</span></p>
                            </section>
                        </article>
                    </section>
                </article>
            </section>
            <section class="section-gestion-usuarios-admin">
                <h2 class="titulo-section-gestion-usuarios-admin">Gestión de Usuarios</h2>
                <p class="enunciado-section">Administra clientes y tenderos de la plataforma</p>
                <article class="container-table-usuarios-admin">
                    <h2 class="titulo-tabla-admin">Listado de usuarios</h2>
                    <table class="tabla-usuarios-admin">
                        <thead>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr class="fila-tabla-gestion-usuarios">
                                <td class="nombre-usuarios">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="rol-usuarios">{{ ucfirst($user->role) }}</td>
                                <td class="estado-usuarios">{{ $user->is_active ? 'Activo' : 'Inactivo' }}</td>
                                <td class="btns-acciones-gestion-usuarios-admin">
                                    <button class="btn-info-usuarios" data-user-id="{{ $user->id }}">Ver</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px;">No hay usuarios registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </article>
            </section>
            <!--DISEÑO MODAL DEL USUARIO-->
            <section class="overlay-section-detalle-usuario-admin">
                <article class="cont-detalles-usuario-admin">
                    <section class="encabezado-info-usuario-admin">
                        <article class="cont-titulo-encabezado">
                            <h2 class="titulo-encabeado" id="modal-usuario-nombre">Nombre de usuario - Rol usuario</h2>
                            <p>Información completa del usuario</p>
                        </article>
                        <img src="{{ asset('img/x-fill-12_.png') }}" alt="" class="cerrar-modal-usuario-info-admin">
                    </section>
                    <section class="cont-info-usuario-admin">
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Información básica</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Nombre: <span id="modal-usuario-nombre-completo">Nombre de la persona</span></p>
                                <p>Teléfono: <span id="modal-usuario-telefono">xxx-xxx-xxxx</span></p>
                                <p>Email: <span id="modal-usuario-email">sergio@gmail.com</span></p>
                                <p>Estado: <span id="modal-usuario-estado">activo</span></p>
                            </section>
                        </article>
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Ubicación</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Dirección: <span id="modal-usuario-direccion">Calle 45 #23-12</span></p>
                                <p>Barrio: <span id="modal-usuario-barrio">Santo Domingo Savio</span></p>
                            </section>
                        </article>
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Información de Cuenta</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Rol: <span id="modal-usuario-rol">Tendero</span></p>
                                <p>Registro: <span id="modal-usuario-registro">15/01/2025</span></p>
                                <p>verificación: <span id="modal-usuario-verificacion">Verificado</span></p>
                            </section>
                        </article>
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Estadísticas de Ventas</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Tiendas registradas: <span id="modal-usuario-tiendas">1</span></p>
                                <p>Pedidos procesados: <span id="modal-usuario-pedidos">28</span></p>
                                <p>Ventas totales: <span id="modal-usuario-ventas">$1.200.000</span></p>
                            </section>
                        </article>
                    </section>
                </article>
            </section>
        </main>
    </section>
    <script src="{{ asset('js/administrador/dashboardAdmin.js') }}"></script>
</x-app-layout>