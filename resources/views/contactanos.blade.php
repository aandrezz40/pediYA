<form method="POST" action="{{ route('contact.send') }}">
    @csrf
    <section class="cont-input">
        <input type="text" name="name" placeholder="Nombre" required>
        <select name="category" required>
            <option value="">Categoría</option>
            <option value="Servicio técnico">Servicio técnico</option>
            <option value="Reclamo">Reclamo</option>
            <option value="Sugerencia">Sugerencia</option>
            <option value="Otro">Otro</option>
        </select>
    </section>

    <input type="email" name="email" class="input-info" placeholder="Correo electrónico" required>
    <textarea name="message" cols="30" rows="10" class="input-info" placeholder="Escribe tu mensaje aquí" required></textarea>

    <button type="submit">Enviar solicitud</button>
</form>

<!-- Mostrar mensaje de éxitoOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
@if (session('success'))
    <p style="color: green; margin-top: 1rem;">{{ session('success') }}</p>
@endif
