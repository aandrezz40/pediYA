<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/administrador/dashboardAdmin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
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
                <p>Sergio Arias</p>
                <p>Administrador</p>
                <a href="">Cerrar sesión</a>
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
                            <tr class="fila-tabla-gestion-tienda">
                                <td class="nombre-tienda">Tienda La Esquina</td>
                                <td>Sergio Arias</td>
                                <td class="estado-tienda">Activa</td>
                                <td class="aprobacion-tienda">Aprobada</td>
                                <td class="btns-acciones-gestion-tienda-admin">
                                    <button class="btn-info-tienda">Ver</button>
                                </td>
                            </tr>
                            <tr class="fila-tabla-gestion-tienda">
                                <td class="nombre-tienda">Tienda La Esquina</td>
                                <td>Sergio Arias</td>
                                <td class="estado-tienda">Inactiva</td>
                                <td class="aprobacion-tienda">Pendiente</td>
                                <td class="btns-acciones-gestion-tienda-admin">
                                    <button class="btn-info-tienda">Ver</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>
            </section>
            <!--DISEÑO MODAL DE LA TIENDA-->
            <section class="overlay-section-detalle-tienda-admin">
                <article class="cont-detalles-tienda-admin">
                    <section class="encabezado-info-tienda-admin">
                        <article class="cont-titulo-encabezado">
                            <h2 class="titulo-encabeado">Nombre de la tienda</h2>
                            <p>Información completa del establecimiento</p>
                        </article>
                        <img src="{{ asset('img/x-fill-12_.png') }}" alt="" class="cerrar-modal-tienda-info-admin">
                    </section>
                    <section class="cont-info-tienda-admin">
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Información básica</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Propietario: <span>Nombre de la persona</span></p>
                                <p>Teléfono: <span>xxx-xxx-xxxx</span></p>
                                <p>Email: <span>sergio@gmail.com</span></p>
                            </section>
                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Operación</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Horario: <span>Lunes a Domingo: 6:00 A.M - 10:00 P.M</span></p>
                                <p>Domicilio: <span>Si</span></p>
                            </section>

                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Métodos de pago</h2>
                            <section class="descripcion-card-tienda-admin">
                                Efectivo, Nequi, Bancolombia
                            </section>

                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Fechas</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Registro: <span>15/01/2025</span></p>
                                <p>Ultima actualización: <span>28/05/2026</span></p>
                            </section>

                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Ubicación</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Dirección: <span>Calle 45 #23-12</span></p>
                                <p>Barrio: <span>Barrio Centro</span></p>
                                <p>Ciudad: <span>Medellín</span></p>
                            </section>

                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Descripción</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p><span>Tienda de barrio con productos básicos y abarrotes</span></p>
                            </section>

                        </article>
                        <article class="card-info-tienda-admin">
                            <h2 class="titulo-card-info-tienda-admin">Estado actual</h2>
                            <section class="descripcion-card-tienda-admin">
                                <p>Estado: <span class="estado-detalles-tienda-admin">Activa</span></p>
                                <p>Aprobacion: <span class="aprobacion-detalles-tienda-admin">Aprobada</span></p>
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
                            <tr class="fila-tabla-gestion-usuarios">
                                <td class="nombre-usuarios">Sergio Arias</td>
                                <td>Sergio@gmail.com</td>
                                <td class="rol-usuarios">Tendero</td>
                                <td class="estado-usuarios">Activo</td>
                                <td class="btns-acciones-gestion-usuarios-admin">
                                    <button class="btn-info-usuarios">Ver</button>
                                </td>
                            </tr>
                            <tr class="fila-tabla-gestion-usuarios">
                                <td class="nombre-usuarios">Sergio Arias</td>
                                <td>Sergio@gmail.com</td>
                                <td class="rol-usuarios">Tendero</td>
                                <td class="estado-usuarios">Inactivo</td>
                                <td class="btns-acciones-gestion-usuarios-admin">
                                    <button class="btn-info-usuarios">Ver</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </article>
            </section>
            <!--DISEÑO MODAL DEL USUARIO-->
            <section class="overlay-section-detalle-usuario-admin">
                <article class="cont-detalles-usuario-admin">
                    <section class="encabezado-info-usuario-admin">
                        <article class="cont-titulo-encabezado">
                            <h2 class="titulo-encabeado">Nombre de usuario - Rol usuario</h2>
                            <p>Información completa del usuario</p>
                        </article>
                        <img src="{{ asset('img/x-fill-12_.png') }}" alt="" class="cerrar-modal-usuario-info-admin">
                    </section>
                    <section class="cont-info-usuario-admin">
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Información básica</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Nombre: <span>Nombre de la persona</span></p>
                                <p>Teléfono: <span>xxx-xxx-xxxx</span></p>
                                <p>Email: <span>sergio@gmail.com</span></p>
                                <p>Estado: <span>activo</span></p>
                            </section>
                        </article>
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Ubicación</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Dirección: <span>Calle 45 #23-12</span></p>
                                <p>Barrio: <span>Santo Domingo Savio</span></p>
                            </section>
                        </article>
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Información de Cuenta</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Rol: <span>Tendero</span></p>
                                <p>Registro: <span>15/01/2025</span></p>
                                <p>verificación: <span>Verificado</span></p>
                            </section>
                        </article>
                        <article class="card-info-usuario-admin">
                            <h2 class="titulo-card-info-usuario-admin">Estadísticas de Ventas</h2>
                            <section class="descripcion-card-usuario-admin">
                                <p>Tiendas registradas: <span>1</span></p>
                                <p>Pedidos procesados: <span>28</span></p>
                                <p>Ventas totales: <span>$1.200.000</span></p>
                            </section>
                        </article>
                    </section>
                </article>
            </section>
        </main>
    </section>
    <script src="{{ asset('js/administrador/dashboardAdmin.js') }}"></script>
</body>
</html>