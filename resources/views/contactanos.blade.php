<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>

    <!-- CSS local con asset() -->
    <link rel="stylesheet" href="{{ asset('css/contactanos.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <h1>Contáctanos</h1>

        <!-- Formulario de contacto -->
        <form action="{{ route('contacto.enviar') }}" method="POST">
            @csrf
            
            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            <section class="cont-input">
                <div class="input-group">
                    <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="input-group">
                    <select name="categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="Servicio técnico" {{ old('categoria') == 'Servicio técnico' ? 'selected' : '' }}>Servicio técnico</option>
                        <option value="Reclamo" {{ old('categoria') == 'Reclamo' ? 'selected' : '' }}>Reclamo</option>
                        <option value="Sugerencia" {{ old('categoria') == 'Sugerencia' ? 'selected' : '' }}>Sugerencia</option>
                        <option value="Otro" {{ old('categoria') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('categoria')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </section>
            
            <div class="input-group">
                <input type="email" name="correo" class="input-info" placeholder="Correo electrónico" value="{{ old('correo') }}" required>
                @error('correo')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="input-group">
                <textarea name="mensaje" cols="30" rows="10" class="input-info" placeholder="Escribe tu mensaje aquí" required>{{ old('mensaje') }}</textarea>
                @error('mensaje')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit">Enviar solicitud</button>
        </form>

        <section class="cont-info">
            <article>
                <img src="{{ asset('img/envelope-solid.svg') }}" alt="Icono de correo">
                <p>aandrezz40@gmail.com</p>
            </article>

            <article>
                <img src="{{ asset('img/map-location-dot-solid.svg') }}" alt="Icono de mapa">
                <p>Medellín, Colombia</p>
            </article>

            <article>
                <img src="{{ asset('img/phone-solid.svg') }}" alt="Icono de teléfono">
                <p>+57 300 691 3882</p>
            </article>
        </section>

        <a href="{{ auth()->check() ? (auth()->user()->role === 'cliente' ? route('homeCliente') : (auth()->user()->role === 'tendero' ? route('homeTendero') : url('/'))) : url('/') }} class="img">
            <img src="{{ asset('img/home.svg') }}" alt="Inicio">
        </a>
    </main>
</body>
</html>
