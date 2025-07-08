<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/users/perfilUsuario.css') }}">
    @endsection

    <main>
        <section class="cont-encabezado">
            <h2>Mi Perfil</h2>
            <p>Gestiona tu información personal y configuración</p>
        </section>

        <section class="cont-configuracion">
            <!-- Información Personal -->
            <article class="cont-config-opciones-cuenta" id="contConfigOpcionesCuenta">
                <section class="cont-info-personal">
                    <img src="{{ asset('img/person.svg') }}" alt="Información personal">
                    <h3>Información Personal</h3>
                    <p>Actualiza tu nombre, email y número de teléfono</p>
                    <button id="abrirContInfoPersonal" class="btn-abrir-cont">Editar</button>
                </section>

                <section class="cont-seguridad-cuenta">
                    <img src="{{ asset('img/lock.svg') }}" alt="Seguridad">
                    <h3>Seguridad de la Cuenta</h3>
                    <p>Cambia tu contraseña</p>
                    <button id="abrirContSeguridad" class="btn-abrir-cont">Cambiar</button>
                </section>

                @if(auth()->user()->role === 'tendero' && auth()->user()->store)
                <section class="cont-info-tienda">
                    <img src="{{ asset('img/settings.svg') }}" alt="Información de tienda">
                    <h3>Información de la Tienda</h3>
                    <p>Gestiona los datos de tu tienda</p>
                    <button id="abrirContInfoTienda" class="btn-abrir-cont">Editar</button>
                </section>
                @endif
            </article>

            <!-- Formulario de Información Personal -->
            <article class="cont-form-info-personal" id="contFormInfoPersonal" style="display: none;">
                <section class="cont-header-form">
                    <h3>Información Personal</h3>
                    <button id="btnCancelarInfoPersonal" class="btn-cerrar">✕</button>
                </section>

                <form method="post" action="{{ route('profile.update') }}" class="form-info-personal">
                    @csrf
                    @method('patch')
                    
                    <div class="cont-campo">
                        <label for="name">Nombre completo</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="cont-campo">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="cont-campo">
                        <label for="phone_number">Número de teléfono</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
                        @error('phone_number')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="cont-botones">
                        <button type="submit" class="btn-guardar">Guardar cambios</button>
                        <button type="button" id="btnCancelarInfoPersonal2" class="btn-cancelar">Cancelar</button>
                    </div>
                </form>
            </article>

            <!-- Formulario de Seguridad -->
            <article class="cont-form-seguridad-cuenta" id="contFormSeguridadCuenta" style="display: none;">
                <section class="cont-header-form">
                    <h3>Cambiar Contraseña</h3>
                    <button id="btnCancelarContrasena" class="btn-cerrar">✕</button>
                </section>

                <form method="post" action="{{ route('profile.update') }}" class="form-seguridad">
                    @csrf
                    @method('patch')
                    
                    <div class="cont-campo">
                        <label for="current_password">Contraseña actual</label>
                        <input type="password" id="current_password" name="current_password" required>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="cont-campo">
                        <label for="password">Nueva contraseña</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="cont-campo">
                        <label for="password_confirmation">Confirmar nueva contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="cont-botones">
                        <button type="submit" class="btn-guardar">Cambiar contraseña</button>
                        <button type="button" id="btnCancelarContrasena2" class="btn-cancelar">Cancelar</button>
                    </div>
                </form>
            </article>

            @if(auth()->user()->role === 'tendero' && auth()->user()->store)
            <!-- Formulario de Información de Tienda -->
            <article class="container-info-tienda" id="contInfoTienda" style="display: none;">
                <section class="cont-header-form">
                    <h3>Información de la Tienda</h3>
                    <button id="btnCancelarInfoTienda" class="btn-cerrar">✕</button>
                </section>

                <div class="cont-info-tienda-actual">
                    <h4>Datos actuales de tu tienda</h4>
                    <div class="info-tienda">
                        <p><strong>Nombre:</strong> {{ auth()->user()->store->name }}</p>
                        <p><strong>Dirección:</strong> {{ auth()->user()->store->address_street }}</p>
                        <p><strong>Barrio:</strong> {{ auth()->user()->store->address_neighborhood }}</p>
                        <p><strong>Teléfono:</strong> {{ auth()->user()->store->delivery_contact_phone ?? 'No especificado' }}</p>
                        <p><strong>Horarios:</strong> {{ auth()->user()->store->schedule ?? 'No especificados' }}</p>
                        <p><strong>Ofrece domicilio:</strong> {{ auth()->user()->store->offers_delivery ? 'Sí' : 'No' }}</p>
                    </div>
                    
                    <div class="cont-botones">
                        <button type="button" class="btn-guardar" onclick="alert('Función de edición de tienda en desarrollo')">Editar tienda</button>
                        <button type="button" id="btnCancelarInfoTienda2" class="btn-cancelar">Cerrar</button>
                    </div>
                </div>
            </article>
            @endif
        </section>
    </main>

    @section('scripts')
        <script src="{{ asset('js/perfilUsuario.js') }}"></script>
    @endsection
</x-app-layout>
