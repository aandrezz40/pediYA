<x-app-layout>
<main>
    <!--BANNER DETALLES DE LA TIENDA-->
    <section class="cont-baner">
        <article class="cont-img">
            <img src="{{ asset('img/slider-3.jpg') }}" alt="">
        </article>
        <article class="cont-info">
            <h2>Nombre de la tienda</h2>
            <section class="cont-horario">
                <img src="{{ asset('img/clock-solid.svg') }}" alt="">
                <h3>Abierto</h3>
            </section>
            <article class="cont-acciones-tienda">
                <button type="submit" class="btn-llamar"><img src="{{ asset('img/phone-solid (1).svg') }}" alt="Imagen de telefono">+57 xxx xxx xxxx</button>
                <button type="submit" class="btn-favorito"><img src="{{ asset('img/heart-solid.svg') }}" alt="Imagen de corazón">Favorito</button>
                <button type="submit" class="btn-mapa"><img src="{{ asset('img/scooter.svg') }}" alt="Imagen de pin de mapa">Domicilio</button>
            </article>
        </article>
    </section>

    <!--MINI NAV-BAR-->
    <section class="cont-opcion">
        <ul>
            <li><a href="#" id="verProductos">Porductos</a></li>
            <li><a href="#" id="verDetalles">Detalles</a></li>
        </ul>
    </section>

    <!--CONTENEDOR DE LA SECCION PRODUCTOS-->
    <section class="cont-productos-tienda" id="contProductosTienda">
        <h2 class="tituloProductos">Productos</h2>
        <article class="cont-categorias">
            <button type="submit" class="btn-categoria">Todos</button>
            <button type="submit" class="btn-categoria">Frutas</button>
            <button type="submit" class="btn-categoria">Verduras</button>
            <button type="submit" class="btn-categoria">Bebidas</button>
            <button type="submit" class="btn-categoria">Granos</button>
        </article>
        <article class="cont-cards-productos">
            <article class="card-producto">
                <section class="cont-img-producto">
                    <img src="{{ asset('img/apple-2788616_640.jpg') }}" alt="">
                </section>
                <section class="cont-info-producto">
                    <h3>Nombre del producto</h3>
                    <p class="descripcionProducto">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    <article class="cont-precio">
                        <p class="precioProducto">$5000.00</p>
                        <section class="cont-cantidad-producto-detalles">
                            <button type="submit">-</button>
                            <span>1</span>
                            <button type="submit">+</button>
                        </section>
                    </article>
                </section>
            </article>
        </article>
    </section>

    <!--CONTENEDOR DE LA SECCION DE DETALLES-->
    <section class="cont-detalles-tienda animate__animated animate__fadeInRight" id="contDetallesTienda">
        <h2 class="tituloDetalles">Detalles Tienda</h2>
        <article class="cont-resenas">
            <section class="resena">
                <p>+13</p>
                <p>Años de experiencia</p>
            </section>
            <section class="resena">
                <p>227</p>
                <p>Pedidos Completados</p>
            </section>
        </article>
        <article class="cont-datos">
            <section class="sect-dato">
                <img src="{{ asset('img/map.svg') }}" alt="">
                <article class="sect-info">
                    <h3>Dirección</h3>
                    <p>Carrera 45 #98-65</p>
                </article>
            </section>
            <section class="sect-dato">
                <img src="{{ asset('img/clock-1.svg') }}" alt="">
                <article class="sect-info">
                    <h3>Horario</h3>
                    <p>Lunes a Viernes: 7:00 AM - 9:00 PM</p>
                    <p>Sábado: 8:00 AM - 8:00 PM</p>
                    <p>Domingo a Viernes: 9:00 AM - 6:00 PM</p>
                </article>
            </section>
            <section class="sect-dato">
                <img src="{{ asset('img/icons8-parte-trasera-de-tarjeta-bancaria-48.png') }}" alt="">
                <article class="sect-info">
                    <h3>Métodos de pago</h3>
                    <p>Efectivo, Tarjetas de crédito, Transferencia, Nequi, Daviplata</p>
                </article>
            </section>
        </article>
        <article class="cont-info-adicional">
            <section class="info-adicional">
                <img src="{{ asset('img/icons8-acerca-de-48.png') }}" alt="">
                <article>
                    <h3>Acerca de</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aspernatur quae sint reprehenderit, itaque repudiandae provident corporis, odio ducimus obcaecati adipisci dicta! Inventore eos modi minima quia non, dolor suscipit numquam esse eius aut dicta laboriosam porro praesentium cumque tenetur est ullam? Error, quasi! Unde et numquam nemo delectus aperiam.</p>
                </article>
            </section>
            <section class="info-adicional">
                <img src="{{ asset('img/person-16.svg') }}" alt="">
                <article>
                    <h3>Propietario</h3>
                    <p>Carlos Mendoza</p>
                    <p>En PediYÁ desde enero 2025</p>
                </article>
            </section>
        </article>
    </section>
</main>


</x-app-layout>
