<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tú cuenta - PediYÁ</title>

    <link rel="stylesheet" href="{{ asset('css/registerV2.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <section class="cont-nombre-empresa">
            <h1>PediYÁ</h1>
            <p>Compra fácil, recoge rápido. PediYÁ...</p>
        </section>

        <section class="container-form">
            <h2>Registro</h2>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:blue">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <form method="POST" action="{{ route('register') }}" id="formRegistro">
                @csrf {{-- ¡IMPORTANTE! Directiva CSRF para seguridad en formularios Laravel --}}

                {{-- Número Telefónico y Nombre Completo  --}}
                <article class="cont-inputs">
                    <input type="text" name="name" id="name" placeholder="Nombre Completo" class="input-info" required autocomplete="name">
                    <input type="tel" name="phone_number" id="numero_telefono" placeholder="Número Telefónico" class="input-info" required autocomplete="phone_number">
                </article>

                {{-- Correo Electrónico --}}
                <article class="cont-inputs">
                    <input type="email" name="email" id="email" placeholder="Correo Electrónico" class="input-info" required autocomplete="email">
                </article>

                {{-- Dirección y Contraseña --}}
                <article class="cont-inputs">
                    <input type="text" name="address_line_1" id="address_line_1" placeholder="Dirección" class="input-info" required autocomplete="street-address">
                    <select name="neighborhood" id="neighborhood" class="selectBarrios" required>
                        <option value="" disabled selected>Barrio</option>
                        <option  value="Las Granjas">Las Granjas</option>
                        @foreach($barrios as $barrio)
                            <option  value="{{ $barrio->nombre_barrio }}">{{ $barrio->nombre_barrio }}</option>
                        @endforeach
                        <!-- Agrega aquí más barrios -->
                    </select>
                </article>

                {{-- Rol --}}
                <article class="cont-inputs">
                    <select name="role" id="rol" required class="selectRol">
                        <option value="" disabled selected>Selecciona un Rol</option>
                        <option value="cliente">Cliente</option>
                        <option value="tendero">Tendero</option>
                    </select>
                    <section class="cont-input-contra">
                        <input type="password" name="password" id="inputContrasena" placeholder="Contraseña" class="input-info" required autocomplete="new-password">
                        
                        {{-- El SVG para el ojo (mostrar/ocultar contraseña) --}}
                        <svg id="imgOjo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                    </section>
                </article>
                
                <input type="submit" value="Registrarse" class="btn-registro">
            </form>
            <article class="cont-links">
                <p class="cont-login">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
                <p class="cont-terminos">Al registrarte aceptas los <a href="#">términos y condiciones</a></p>
            </article>
        </section>
    </main>
    <dialog id="modalError" class="modal-error" closedby="any">
        <div class="modal-content">
          <p id="mensajeError">Texto del error aquí</p>
          <button id="cerrarModal">Entendido</button>
        </div>
    </dialog>
    <script src="{{ asset('js/register.js') }}"></script>
    <script src="{{ asset('js/validacionContrasena.js') }}"></script>
</body>
</html>