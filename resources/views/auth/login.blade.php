<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inicia Sesión - PediYÁ</title>

    <!-- CSS con asset() -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet" />
</head>
<body>
    <main>
        <section class="cont-nombre-empresa">
            <h1>PediYÁ</h1>
            <p>Compra fácil, recoge rápido. PediYÁ...</p>
        </section>

        <section class="container-form">
            <h2>Inicia Sesión</h2>

            <!-- Mostrar errores generales -->
            @if ($errors->any())
                <div style="color:red; margin-bottom: 1rem;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <article class="cont-inputs">
                    <input
                        type="email"
                        name="email"
                        placeholder="Correo Electrónico"
                        class="input-info"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />
                </article>

                <section class="cont-input-contra">
                    <input
                        type="password"
                        id="inputContrasena"
                        name="password"
                        placeholder="Contraseña"
                        class="input-info"
                        required
                        autocomplete="current-password"
                    />
                    <svg
                        id="imgOjo"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 576 512"
                        style="cursor:pointer;"
                        onclick="togglePasswordVisibility()"
                    >
                        <path
                            d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"
                        />
                    </svg>
                </section>

                <article class="cont-inputs" style="margin-top:1rem;">
                    <label class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        />
                        <span class="ms-2 text-sm text-gray-600">Recuérdame</span>
                    </label>
                </article>

                <input type="submit" value="Iniciar Sesión" class="btn-registro" />
            </form>

            <article class="cont-links" style="margin-top: 1rem;">
                <p class="cont-login">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}">Regístrate</a>
                </p>

                @if (Route::has('password.request'))
                    <p>
                        <a href="{{ route('password.request') }}" class="underline text-sm">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </p>
                @endif
            </article>
        </section>
    </main>

    <script src="{{ asset('js/register.js') }}"></script>

    <script>
        // Mostrar / ocultar contraseña
        function togglePasswordVisibility() {
            const input = document.getElementById('inputContrasena');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>
</body>
</html>
