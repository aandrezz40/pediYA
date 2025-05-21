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

        <!-- Puedes definir la acción a una ruta si lo necesitas -->
        <form action="{{ route('contacto.enviar') }}" method="POST">
            @csrf
            <section class="cont-input">
                <input type="text" name="nombre" placeholder="Nombre">
                <select name="categoria">
                    <option value="">Categoria</option>
                    <option value="Servicio técnico">Servicio técnico</option>
                    <option value="Reclamo">Reclamo</option>
                    <option value="Sugerencia">Sugerencia</option>
                    <option value="Otro">Otro</option>
                </select>
            </section>
            <input type="email" name="correo" class="input-info" placeholder="Correo electrónico">
            <textarea name="mensaje" cols="30" rows="10" class="input-info" placeholder="Escribe tu mensaje aquí"></textarea>
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

        <a href="{{ url('/') }}" class="img">
            <img src="{{ asset('img/home.svg') }}" alt="Inicio">
        </a>
    </main>
</body>
</html>
