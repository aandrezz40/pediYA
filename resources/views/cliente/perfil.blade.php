<x-app-layout>
    <section class="container-aside animate__animated  animate__fadeInDown">
        <section class="cont-aside-perfil">
            <article class="cont-titulo-perfil">
                <img src="{{ asset('img/person-16.svg') }}">
                <h2>Mi cuenta</h2>
            </article>
            <article class="aside-navBar-perfil">
                <ul id="btnAjusteCuenta">
                    <li>
                        <img src="{{ asset('img/rueda-dentada (1).png') }}" alt="">
                        <a>Ajustes de cuenta</a>
                    </li>
                </ul>
            </article>
        </section>    
    </section>

    <!-- CONTENEDOR DE AJUSTES -->
    <section class="cont-config-opciones animate__animated  animate__fadeInRight">
        <h2 class="tituloSecundario">Ajustes de cuenta</h2>

        <article class="cont-cards-config">
            <section class="card-config" id="abrirContInfoPersonal">
                <article class="cont-titulo-card">
                    <img src="{{ asset('img/person.svg') }}" alt="">
                    <h3 class="tituloCard">Información Personal</h3>
                </article>
                <p>Actualiza tu nombre, correo, teléfono y otra información básica de tu cuenta</p>
            </section>

            <section class="card-config" id="abrirContSeguridad">
                <article class="cont-titulo-card">
                    <img src="{{ asset('img/lock.svg') }}" alt="">
                    <h3 class="tituloCard">Seguridad</h3>
                </article>
                <p>Cambia tu contraseña</p>
            </section>

            <section class="card-config" id="abirContInfoTienda">
                <article class="cont-titulo-card">
                    <img src="{{ asset('img/logo-v1.1.png') }}" alt="">
                    <h3 class="tituloCard">Tu tienda</h3>
                </article>
                <p>Actualiza los datos referentes a tu tienda</p>
            </section>
        </article>
    </section>

    <!-- CONTENEDOR PARA EDITAR LA INFORMACIÓN PERSONAL -->
    <section class="cont-form-personal animate__animated animate__fadeInRight">
        <section class="cont-titulo-personal">
            <article class="titulo-personal">
                <img src="{{ asset('img/person.svg') }}" alt="">
                <h3 class="tituloCard">Información Personal</h3>
            </article>
            <p>Actualiza tu información personal para mantener tu cuenta al día. Esta información nos ayuda a brindarte un mejor servicio.</p>
        </section>
        <h3 class="subTitutlo">Datos personales</h3>
        <form action="{{ route('updateUser') }}" method="POST">
            @csrf
            @method('PUT')

            <article class="cont-inputs">
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" id="nombre" required>
            </article>

            <article class="cont-inputs">
                <label for="telefono">Teléfono</label>
                <input type="number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" id="telefono">
            </article>

            <article class="cont-inputs">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" id="correo" required>
            </article>

            <article class="cont-inputs">
                <label for="direccion">Dirección Principal</label>
                <input type="text" name="address_line_1" value="{{ old('address_line_1', $user->address->address_line_1 ?? '') }}" id="direccion">
            </article>

            <article class="cont-inputs">
                <label for="barrio">Barrio</label>
                <input type="text" name="neighborhood" value="{{ old('neighborhood', $user->address->neighborhood ?? '') }}" id="barrio">
            </article>

            <article class="cont-btn-form">
                <button type="button" class="btn-cancelar" id="btnCancelarInfoPersonal">Cancelar</button>
                <input type="submit" value="Guardar Cambios" class="btn-guardar">
            </article>
        </form>
    </section>

    <!-- CONTENEDOR PARA EDITAR LA CONTRASEÑA -->
    <section class="container-form-seguridad animate__animated animate__fadeInRight">
        <article class="cont-titulo-personal">
            <article class="titulo-personal">
                <img src="{{ asset('img/lock.svg') }}" alt="">
                <h3 class="tituloCard">Seguridad</h3>
            </article>
            <p>Gestiona la configuración de seguridad de tu cuenta para mantener tu información protegida.</p>
        </article>

        <article class="cont-confirmacion-formulario">
            <img src="{{ asset('img/verified.svg') }}" alt="">
            <article class="titulo-confirmacion">
                <h3 class="tituloConfirmación">Tu cuenta está protegida</h3>
                <p>Has completado las recomendaciones de seguridad.</p>
            </article>
        </article>

        <h3 class="subTitutlo">Cambiar Contraseña</h3>



<form action="{{ route('updatePassword') }}" method="POST">
    @csrf

    <article class="cont-inputs-contrasena">
        <label for="contrasenaActual">Contraseña actual</label>
        <input 
            type="password" 
            name="current_password" 
            id="contrasenaActual" 
            placeholder="Ingresa tu contraseña actual" 
            required>
    </article>

    <article class="cont-inputs-contrasena">
        <label for="contrasenaNueva">Nueva contraseña</label>
        <input 
            type="password" 
            name="new_password" 
            id="contrasenaNueva" 
            placeholder="Ingresa su contraseña nueva" 
            required>
        <section class="cont-progreso">
            <div class="progreso"></div>
            <div class="progreso"></div>
            <div class="progreso"></div>
            <div class="progreso"></div>
        </section>
        <p id="infoDebilidad"></p>
    </article>

    <article class="cont-inputs-contrasena">
        <label for="confirmarContrasena">Confirmar nueva contraseña</label>
        <input 
            type="password" 
            name="new_password_confirmation" 
            id="confirmarContrasena" 
            placeholder="Confirma  tu nueva contraseña" 
            required>
    </article>

    <article class="cont-btn-form">
        <button type="button" class="btn-cancelar" id="btnCancelarContrasena">Cancelar</button>
        <input type="submit" value="Actualizar contraseña" class="btn-guardar" id="btnActualizarContrasena">
    </article>
</form>
    </section>


    <dialog id="modalCencelar" closedby="any">
        <article class="cont-info-modal">
            <h3>¿Estás seguro que quieres cancelar esta acción?</h3>
            <section class="cont-btn-modal">
                <button id="btnCancelarModal">Cancelar</button>
                <button id="btnAceptarModal">Aceptar</button>
            </section>
        </article>
    </dialog>

</x-app-layout>