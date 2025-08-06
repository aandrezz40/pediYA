<x-app-layout>
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/users/perfilUsuario.css') }}">
@endsection


<article class="main-perfil-usuario">
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
    <section class="cont-config-opciones animate__animated  animate__fadeInRight" id="contConfigOpcionesCuenta">
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

            @if($user->role === 'tendero')
            <section class="card-config" id="abirContInfoTienda">
                <article class="cont-titulo-card">
                    <img src="{{ asset('img/logo-v1.1.png') }}" alt="">
                    <h3 class="tituloCard">Tu tienda</h3>
                </article>
                <p>Actualiza los datos referentes a tu tienda</p>
            </section>
            @endif
        </article>
    </section>

    <!-- CONTENEDOR PARA EDITAR LA INFORMACIÓN PERSONAL -->
    <section class="cont-form-personal animate__animated animate__fadeInRight" id="contFormInfoPersonal">
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

    <select name="neighborhood" id="neighborhood" class="selectBarrios" required>
        @php
            $barrioActual = old('neighborhood', $user->address->neighborhood ?? '');
        @endphp

        @foreach($barrios as $barrio)
            <option value="{{ $barrio->nombre_barrio }}"
                {{ $barrioActual === $barrio->nombre_barrio ? 'selected' : '' }}>
                {{ $barrio->nombre_barrio }}
            </option>
        @endforeach
    </select>
</article>

            <article class="cont-btn-form">
                <button type="button" class="btn-cancelar" id="btnCancelarInfoPersonal">Cancelar</button>
                <input type="submit" value="Guardar Cambios" class="btn-guardar">
            </article>
        </form>
    </section>

    <!-- CONTENEDOR PARA EDITAR LA CONTRASEÑA -->
    <section class="container-form-seguridad animate__animated animate__fadeInRight" id="contFormSeguridadCuenta">
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
    <!--CONTENEDOR PARA EDITAR LA TIENDA-->
    @if($user->role === 'tendero')
    <section class="container-info-tienda animate__animated  animate__fadeInRight">
        <article class="cont-encabezado-tienda">
            <section>
                <img src="{{ asset('img/logo-v1.1.png') }}" alt="">
                <h3 class="tituloEncabezado">Tu tienda</h3>
            </section>
            <p class="parrafoEncabezado">Actualiza la información de tu tienda para que tus clientes puedan conocerte mejor y hacer pedidos fácilmente.</p>
        </article>
        <article class="mini-nav-tienda">
            <ul>
                <li class="btn-tienda activeInfoTienda" id="btnInfoBasica">Información básica</li>
                <li class="btn-tienda" id="btnDatosEnvio">Horarios</li>
                <li class="btn-tienda" id="btnDatosPago">Métodos de pago</li>
            </ul>
        </article>
        <article class="cont-vista-previa">
            <section class="encabezado-vista-previa">
                <h4>Vista previa de tu tienda</h4>
            </section>
            <section class="cont-info-tienda">
                <article class="cont-img-tienda">
                    <img id="imgPreviewVista" src="{{asset('storage/'.$store->logo_path)}}" alt="Imagen de la tienda">
                    <section class="info-img">
                        <h3 class="nombreTienda">{{ $store->name ?? 'Nombre de la tienda' }}</h3>
                        <p class="descripcionTienda">{{ $store->description ?? 'Descripción de la tienda' }}</p>
                    </section>
                </article>
                <article class="cont-datos">
                    <section class="dato">
                        <h4>Dirección</h4>
                        <p>{{ $store->address_street ?? 'Dirección de la tienda' }}</p>
                    </section>
                    <section class="dato">
                        <h4>Horario</h4>
                        <p>{{ $store->schedule ?? 'Lunes - Sábado 8:00 a.m - 8:00 p.m' }}</p>
                    </section>
                    <section class="dato">
                        <h4>Teléfono</h4>
                        <p>{{ $store->delivery_contact_phone ?? '+57 xxx xxx xxxx' }}</p>
                    </section>
                </article>
            </section>
        </article>
        <!--CONTENEDOR FORMULARIO DE DATOS BASICOS-->
        <article class="cont-formulario-basico">
            <h3 class="subTituloTienda">Datos de la tienda</h3>
            <form action="{{ route('tendero.updateStoreBasic') }}" method="POST" enctype="multipart/form-data" class="formulario-tienda-datos">
                @csrf
                <!-- Nombre de la tienda -->
                <section class="cont-inputs-tienda">
                    <label for="nombreTienda">Nombre de la tienda</label>
                    <input type="text" id="nombreTienda" name="store_name" value="{{ old('store_name', $store->name ?? '') }}" required>
                </section>
                <!-- Teléfono de contacto para domicilios -->
                <section class="cont-inputs-tienda">
                    <label for="telefonoTienda">Teléfono</label>
                    <input type="text" id="telefonoTienda" name="delivery_contact_phone" value="{{ old('delivery_contact_phone', $store->delivery_contact_phone ?? '') }}">
                </section>

                <section class="cont-inputs-tienda">
                    <label for="descripcionTienda">Descripción</label>
                    <textarea id="descripcionTienda" name="description" cols="30" rows="3">{{ old('description', $store->description ?? '') }}</textarea>
                </section>
                <!-- Imagen de la tienda -->
                <section class="cont-input-info-basica-editar-img">
                    <label for="imagenInput">Sube imagen de tu tienda
                        <img id="imgPreview" src="{{asset('storage/'.$store->logo_path)}}" alt="Imagen de la tienda" style="width:100px; height:70px; object-fit:cover; border-radius:10px;">
                    </label>
                    <input type="file" accept="image/*" id="imagenInput" name="image" class="input-subir-imagen">

                </section>
                <!-- Dirección -->
                <section class="cont-inputs-tienda">
                    <label for="direccionTienda">Dirección</label>
                    <input type="text" id="direccionTienda" name="address_line_1" value="{{ old('address_line_1', $store->address_street ?? '') }}">
                </section>
                <!-- Barrio -->
                <section class="cont-inputs-tienda">
                    <label for="barrioTienda">Barrio</label>
                    <input type="text" id="barrioTienda" name="address_neighborhood" value="{{ old('address_neighborhood', $store->address_neighborhood ?? '') }}">
                </section>
                <section class="cont-btn-form">
                    <button type="button" class="btn-cancelar" id="btnCancelarInfoTienda">Cancelar</button>
                    <input type="submit" value="Guardar Cambios" class="btn-guardar">
                </section>
            </form>
        </article>
            <!--CONTENEDOR FORMULARIO DE HORARIOS-->
            @php
                $horas = [
                    '5:00 a.m', '6:00 a.m', '7:00 a.m', '8:00 a.m', '9:00 a.m', '10:00 a.m', '11:00 a.m', '12:00 a.m',
                    '1:00 p.m', '2:00 p.m', '3:00 p.m', '4:00 p.m', '5:00 p.m', '6:00 p.m', '7:00 p.m', '8:00 p.m', '9:00 p.m', '10:00 p.m'
                ];
                if (!isset($horarios)) {
                    $horarios = [];
                }
            @endphp
            <article class="cont-formulario-horarios animate__animated  animate__fadeInRight">
                <h3 class="subTituloTienda">Configura tus horarios de atención</h3>
                <form action="{{ route('tendero.updateStoreSchedule') }}" method="POST" class="formulario-tienda-horarios">
                    @csrf
                    <!-- Lunes -->
                    <section class="cont-checkbox">
                        <label for="checkboxLunes">Lunes
                            <input type="checkbox" id="checkboxLunes" class="checkbox" name="schedule_lunes" value="1" {{ (isset($horarios['lunes']) && $horarios['lunes']['checked']) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="lunes_start">
                                @if(isset($horarios['lunes']['start']))
                                    <option value="{{ $horarios['lunes']['start'] }}" selected>{{ $horarios['lunes']['start'] }}</option>
                                @else
                                    <option value="" selected>Hora inicio</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['lunes']['start']) || $hora != $horarios['lunes']['start'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span>a</span>
                            <select name="lunes_end">
                                @if(isset($horarios['lunes']['end']))
                                    <option value="{{ $horarios['lunes']['end'] }}" selected>{{ $horarios['lunes']['end'] }}</option>
                                @else
                                    <option value="" selected>Hora fin</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['lunes']['end']) || $hora != $horarios['lunes']['end'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </article>
                    </section>
                    <!-- Martes -->
                    <section class="cont-checkbox">
                        <label for="checkboxMartes">Martes
                            <input type="checkbox" id="checkboxMartes" class="checkbox" name="schedule_martes" value="1" {{ (isset($horarios['martes']) && $horarios['martes']['checked']) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="martes_start">
                                @if(isset($horarios['martes']['start']))
                                    <option value="{{ $horarios['martes']['start'] }}" selected>{{ $horarios['martes']['start'] }}</option>
                                @else
                                    <option value="" selected>Hora inicio</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['martes']['start']) || $hora != $horarios['martes']['start'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span>a</span>
                            <select name="martes_end">
                                @if(isset($horarios['martes']['end']))
                                    <option value="{{ $horarios['martes']['end'] }}" selected>{{ $horarios['martes']['end'] }}</option>
                                @else
                                    <option value="" selected>Hora fin</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['martes']['end']) || $hora != $horarios['martes']['end'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </article>
                    </section>
                    <!-- Miércoles -->
                    <section class="cont-checkbox">
                        <label for="checkboxMiercoles">Miércoles
                            <input type="checkbox" id="checkboxMiercoles" class="checkbox" name="schedule_miercoles" value="1" {{ (isset($horarios['miercoles']) && $horarios['miercoles']['checked']) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="miercoles_start">
                                @if(isset($horarios['miercoles']['start']))
                                    <option value="{{ $horarios['miercoles']['start'] }}" selected>{{ $horarios['miercoles']['start'] }}</option>
                                @else
                                    <option value="" selected>Hora inicio</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['miercoles']['start']) || $hora != $horarios['miercoles']['start'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span>a</span>
                            <select name="miercoles_end">
                                @if(isset($horarios['miercoles']['end']))
                                    <option value="{{ $horarios['miercoles']['end'] }}" selected>{{ $horarios['miercoles']['end'] }}</option>
                                @else
                                    <option value="" selected>Hora fin</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['miercoles']['end']) || $hora != $horarios['miercoles']['end'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </article>
                    </section>
                    <!-- Jueves -->
                    <section class="cont-checkbox">
                        <label for="checkboxJueves">Jueves
                            <input type="checkbox" id="checkboxJueves" class="checkbox" name="schedule_jueves" value="1" {{ (isset($horarios['jueves']) && $horarios['jueves']['checked']) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="jueves_start">
                                @if(isset($horarios['jueves']['start']))
                                    <option value="{{ $horarios['jueves']['start'] }}" selected>{{ $horarios['jueves']['start'] }}</option>
                                @else
                                    <option value="" selected>Hora inicio</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['jueves']['start']) || $hora != $horarios['jueves']['start'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span>a</span>
                            <select name="jueves_end">
                                @if(isset($horarios['jueves']['end']))
                                    <option value="{{ $horarios['jueves']['end'] }}" selected>{{ $horarios['jueves']['end'] }}</option>
                                @else
                                    <option value="" selected>Hora fin</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['jueves']['end']) || $hora != $horarios['jueves']['end'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </article>
                    </section>
                    <!-- Viernes -->
                    <section class="cont-checkbox">
                        <label for="checkboxViernes">Viernes
                            <input type="checkbox" id="checkboxViernes" class="checkbox" name="schedule_viernes" value="1" {{ (isset($horarios['viernes']) && $horarios['viernes']['checked']) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="viernes_start">
                                @if(isset($horarios['viernes']['start']))
                                    <option value="{{ $horarios['viernes']['start'] }}" selected>{{ $horarios['viernes']['start'] }}</option>
                                @else
                                    <option value="" selected>Hora inicio</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['viernes']['start']) || $hora != $horarios['viernes']['start'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span>a</span>
                            <select name="viernes_end">
                                @if(isset($horarios['viernes']['end']))
                                    <option value="{{ $horarios['viernes']['end'] }}" selected>{{ $horarios['viernes']['end'] }}</option>
                                @else
                                    <option value="" selected>Hora fin</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['viernes']['end']) || $hora != $horarios['viernes']['end'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </article>
                    </section>
                    <!-- Sábado -->
                    <section class="cont-checkbox">
                        <label for="checkboxSabado">Sábado
                            <input type="checkbox" id="checkboxSabado" class="checkbox" name="schedule_sabado" value="1" {{ (isset($horarios['sabado']) && $horarios['sabado']['checked']) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="sabado_start">
                                @if(isset($horarios['sabado']['start']))
                                    <option value="{{ $horarios['sabado']['start'] }}" selected>{{ $horarios['sabado']['start'] }}</option>
                                @else
                                    <option value="" selected>Hora inicio</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['sabado']['start']) || $hora != $horarios['sabado']['start'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span>a</span>
                            <select name="sabado_end">
                                @if(isset($horarios['sabado']['end']))
                                    <option value="{{ $horarios['sabado']['end'] }}" selected>{{ $horarios['sabado']['end'] }}</option>
                                @else
                                    <option value="" selected>Hora fin</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['sabado']['end']) || $hora != $horarios['sabado']['end'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </article>
                    </section>
                    <!-- Domingo -->
                    <section class="cont-checkbox">
                        <label for="checkboxDomingo">Domingo
                            <input type="checkbox" id="checkboxDomingo" class="checkbox" name="schedule_domingo" value="1" {{ (isset($horarios['domingo']) && $horarios['domingo']['checked']) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="domingo_start">
                                @if(isset($horarios['domingo']['start']))
                                    <option value="{{ $horarios['domingo']['start'] }}" selected>{{ $horarios['domingo']['start'] }}</option>
                                @else
                                    <option value="" selected>Hora inicio</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['domingo']['start']) || $hora != $horarios['domingo']['start'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span>a</span>
                            <select name="domingo_end">
                                @if(isset($horarios['domingo']['end']))
                                    <option value="{{ $horarios['domingo']['end'] }}" selected>{{ $horarios['domingo']['end'] }}</option>
                                @else
                                    <option value="" selected>Hora fin</option>
                                @endif
                                @foreach($horas as $hora)
                                    @if(!isset($horarios['domingo']['end']) || $hora != $horarios['domingo']['end'])
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </article>
                    </section>
                    <section class="cont-check-domicilio">
                        <h3 class="titulo-servicio-domicilio">Servicios  que ofreces</h3>
                        <input type="checkbox" id="checkboxDomicilio" name="offers_delivery" value="1" class="checkboxServicioDomicilio" {{ old('offers_delivery', $store->offers_delivery ?? false) ? 'checked' : '' }}>
                        <label for="checkboxDomicilio" class="checkbox-Domicilio">
                            <img src="{{ asset('img/scooter.svg')}}" alt="">
                            <p class="sub-titulo-servicio-domicilio">Domicilio</p>
                            <p class="info-servicio-domicilio">Ofreces servicio de entrega a domicilio (gestionado por ti)</p>
                        </label>
                    </section>

                    <section class="cont-btn-form">
                        <button type="button" class="btn-cancelar" id="btnCancelarHorarios">Cancelar</button>
                        <input type="submit" value="Guardar Cambios" class="btn-guardar">
                    </section>
                </form>
            </article>
        <!--CONTENEDOR FORMULARIO DE METODOS DE PAGO-->
        <article class="cont-formulario-pago animate__animated  animate__fadeInRight">
            <h3 class="subTituloTienda">Configura Métodos de pago</h3>
            <p class="parrafoEncabezado2">Selecciona los métodos de pago que aceptas en tu tienda para facilitar las compras de tus clientes. Los clientes podrán ver esta información antes de realizar un pedido.</p>
            <p>Métodos disponibles <span class="spanSubtema">Selecciona los que aceptas</span></p>
            <form action="{{ route('tendero.updateStorePaymentMethods') }}" method="POST" class="formulario-tienda-pago">
                @csrf
                <!-- Efectivo -->
                <section class="cont-checkbox-pago">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#000000"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path  d="M64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L64 64zm64 320l-64 0 0-64c35.3 0 64 28.7 64 64zM64 192l0-64 64 0c0 35.3-28.7 64-64 64zM448 384c0-35.3 28.7-64 64-64l0 64-64 0zm64-192c-35.3 0-64-28.7-64-64l64 0 0 64zM176 256a112 112 0 1 1 224 0 112 112 0 1 1 -224 0zm76-48c0 9.7 6.9 17.7 16 19.6l0 48.4-4 0c-11 0-20 9-20 20s9 20 20 20l24 0 24 0c11 0 20-9 20-20s-9-20-20-20l-4 0 0-68c0-11-9-20-20-20l-16 0c-11 0-20 9-20 20z"/></svg>
                    <label for="checkboxEfectivo">Efectivo
                        <input type="checkbox" id="checkboxEfectivo" name="payment_methods[]" value="1" class="checkboxMetodo" {{ in_array(1, $store->paymentMethods->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <p>Pagos en persona con dinero en efectivo</p>
                    </label>
                </section>

                <!-- Transferencia bancaria -->
                <section class="cont-checkbox-pago">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#000000"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M243.4 2.6l-224 96c-14 6-21.8 21-18.7 35.8S16.8 160 32 160l0 8c0 13.3 10.7 24 24 24l400 0c13.3 0 24-10.7 24-24l0-8c15.2 0 28.3-10.7 31.3-25.6s-4.8-29.9-18.7-35.8l-224-96c-8-3.4-17.2-3.4-25.2 0zM128 224l-64 0 0 196.3c-.6 .3-1.2 .7-1.8 1.1l-48 32c-11.7 7.8-17 22.4-12.9 35.9S17.9 512 32 512l448 0c14.1 0 26.5-9.2 30.6-22.7s-1.1-28.1-12.9-35.9l-48-32c-.6-.4-1.2-.7-1.8-1.1L448 224l-64 0 0 192-40 0 0-192-64 0 0 192-48 0 0-192-64 0 0 192-40 0 0-192zM256 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                    <label for="checkboxTransferencia">Transferencia bancaria
                        <input type="checkbox" id="checkboxTransferencia" name="payment_methods[]" value="2" class="checkboxMetodo" {{ in_array(2, $store->paymentMethods->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <p>Pagos mediante transferencia</p>
                    </label>
                </section>

                <!-- Nequi -->
                <section class="cont-checkbox-pago">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#000000"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path  d="M0 80C0 53.5 21.5 32 48 32l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48L0 80zM64 96l0 64 64 0 0-64L64 96zM0 336c0-26.5 21.5-48 48-48l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48l0-96zm64 16l0 64 64 0 0-64-64 0zM304 32l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48l0-96c0-26.5 21.5-48 48-48zm80 64l-64 0 0 64 64 0 0-64zM256 304c0-8.8 7.2-16 16-16l64 0c8.8 0 16 7.2 16 16s7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s7.2-16 16-16s16 7.2 16 16l0 96c0 8.8-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s-7.2-16-16-16s-16 7.2-16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-160zM368 480a16 16 0 1 1 0-32 16 16 0 1 1 0 32zm64 0a16 16 0 1 1 0-32 16 16 0 1 1 0 32z"/></svg>
                    <label for="checkboxNequi">Nequi
                        <input type="checkbox" id="checkboxNequi" name="payment_methods[]" value="3" class="checkboxMetodo" {{ in_array(3, $store->paymentMethods->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <p>Pagos con Nequi</p>
                    </label>
                </section>

                <!-- PSE -->
                <section class="cont-checkbox-pago">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#000000"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path  d="M0 80C0 53.5 21.5 32 48 32l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48L0 80zM64 96l0 64 64 0 0-64L64 96zM0 336c0-26.5 21.5-48 48-48l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48l0-96zm64 16l0 64 64 0 0-64-64 0zM304 32l96 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48l-96 0c-26.5 0-48-21.5-48-48l0-96c0-26.5 21.5-48 48-48zm80 64l-64 0 0 64 64 0 0-64zM256 304c0-8.8 7.2-16 16-16l64 0c8.8 0 16 7.2 16 16s7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s7.2-16 16-16s16 7.2 16 16l0 96c0 8.8-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s-7.2-16-16-16s-16 7.2-16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-160zM368 480a16 16 0 1 1 0-32 16 16 0 1 1 0 32zm64 0a16 16 0 1 1 0-32 16 16 0 1 1 0 32z"/></svg>
                    <label for="checkboxPSE">PSE
                        <input type="checkbox" id="checkboxPSE" name="payment_methods[]" value="4" class="checkboxMetodo" {{ in_array(4, $store->paymentMethods->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <p>Pagos con PSE</p>
                    </label>
                </section>

                <!-- Tarjeta de Crédito -->
                <section class="cont-checkbox-pago">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#000000"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path  d="M64 32C28.7 32 0 60.7 0 96l0 32 576 0 0-32c0-35.3-28.7-64-64-64L64 32zM576 224L0 224 0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-192zM112 352l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z"/></svg>
                    <label for="checkboxTarjetaCredito">Tarjeta de Crédito
                        <input type="checkbox" id="checkboxTarjetaCredito" name="payment_methods[]" value="5" class="checkboxMetodo" {{ in_array(5, $store->paymentMethods->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <p>Pagos con tarjeta de crédito en persona</p>
                    </label>
                </section>

                <!-- Tarjeta de Débito -->
                <section class="cont-checkbox-pago">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#000000"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path  d="M64 32C28.7 32 0 60.7 0 96l0 32 576 0 0-32c0-35.3-28.7-64-64-64L64 32zM576 224L0 224 0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-192zM112 352l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16z"/></svg>
                    <label for="checkboxTarjetaDebito">Tarjeta de Débito
                        <input type="checkbox" id="checkboxTarjetaDebito" name="payment_methods[]" value="6" class="checkboxMetodo" {{ in_array(6, $store->paymentMethods->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <p>Pagos con tarjeta de débito en persona</p>
                    </label>
                </section>

                <section class="cont-btn-form">
                    <button type="button" class="btn-cancelar" id="btnCancelarMetodoPago">Cancelar</button>
                    <input type="submit" value="Guardar Cambios" class="btn-guardar">
                </section>
            </form>
        </article>
        
    </section>
    @endif

    <dialog id="modalCencelar" closedby="any">
        <article class="cont-info-modal">
            <h3>¿Estás seguro que quieres cancelar esta acción?</h3>
            <section class="cont-btn-modal">
                <button id="btnCancelarModal">Cancelar</button>
                <button id="btnAceptarModal">Aceptar</button>
            </section>
        </article>
    </dialog>
</article>

@section('scripts')
    <script src="{{ asset('js/perfilUsuario.js') }}"></script>
    <script>
        document.getElementById('imagenInput')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    document.getElementById('imgPreview').src = evt.target.result;
                    document.getElementById('imgPreviewVista').src = evt.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (window.horariosTienda) {
                Object.entries(window.horariosTienda).forEach(([dia, datos]) => {
                    // Checkbox
                    const checkbox = document.getElementById('checkbox' + dia.charAt(0).toUpperCase() + dia.slice(1));
                    if (checkbox) checkbox.checked = !!datos.checked;

                    // Selects
                    const startSelect = document.querySelector(`select[name='${dia}_start']`);
                    const endSelect = document.querySelector(`select[name='${dia}_end']`);
                    if (startSelect && datos.start) {
                        Array.from(startSelect.options).forEach(opt => {
                            opt.selected = (opt.value.trim() === datos.start.trim());
                        });
                    }
                    if (endSelect && datos.end) {
                        Array.from(endSelect.options).forEach(opt => {
                            opt.selected = (opt.value.trim() === datos.end.trim());
                        });
                    }
                });
            }
        });
    </script>
    <script>
        window.horariosTienda = @json($horarios);
    </script>
@endsection
</x-app-layout>