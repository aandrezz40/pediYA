<x-app-layout>
<article class="main-historial-pedido">
    <section class="cont-aside-pedidos">
        <article class="cont-info-usuario">
            <section>
                {{-- <img src="{{ asset('img/person-16.svg') }}"> --}}
                <h2>{{$user->name}}</h2>
            </section>
            <p>{{$user->address->address_line_1}}</p>
        </article>
        <article class="aside-navBar">
            <ul>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#000000"><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                    <a href="{{ url('/home') }}">Panel principal</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#ffffff" d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM80 64l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L80 96c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96l192 0c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32L96 352c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32zm0 32l0 64 192 0 0-64L96 256zM240 416l64 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-64 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                    <a href="">Mis pedidos</a>
                </li>
            </ul>
        </article>
    </section>

    <!-- CONTENEDOR DE PEDIDOS -->
<section class="cont-pedidos">
    <h2 class="tituloSecundario">Mis pedidos</h2>

    @forelse ($orders as $order)
        <article class="cont-card-pedido">
            <section class="cont-info-pedido">
                <h3>{{ $order->store->name }}</h3>
                @if ($order->store->offers_delivery == 1)
                    <p class="info-pedido-domicilio">Comunicate con la tienda para el domicilio: {{ $order->store->delivery_contact_phone }}</p>
                @else
                    <p>La tienda no ofrece servicio a domicilio.</p>
                @endif
                <p id="infoProceso" class="info-proceso">{{ ucfirst($order->status) }}</p>
            </section>

            <section class="cont-productos-pedido">
                @php
                    // Agrupar los productos por categoría para ese pedido
                    $itemsGroupedByCategory = $order->orderItems->groupBy(function ($item) {
                        return $item->product->category->name ?? 'Sin categoría';
                    });
                @endphp

                @foreach ($itemsGroupedByCategory as $categoryName => $items)
                    <section class="cont-categoria-producto">
                        <article class="cont-titulo-categoria">
                            <h3>{{ $categoryName }}</h3>
                        </article>

                        @foreach ($items as $item)
                            <article class="producto-pedido">
                                <img src="{{ asset('img/rice-ball_.png') }}" alt="Producto">
                                <section>
                                    <p>{{ $item->product->name }}</p>
                                    <p>${{ number_format($item->product->price, 2) }}</p>
                                </section>
                                <span>x{{ $item->quantity }}</span>
                            </article>
                        @endforeach
                    </section>
                @endforeach
            </section>

            <section class="cont-mensaje-cliente">
                <img src="{{ asset('img/comments-regular.svg') }}" alt="Icono de comentario">
                <p>{{ $order->customer_notes ?? 'Sin mensaje adicional' }}</p>
            </section>

            <article class="cont-info-pedido">
                <section class="cont-total-pedido">
                    <p>Total: ${{ number_format($order->total_amount, 2) }}</p>
                    <p>{{ $order->created_at->format('d/m/Y - h:i A') }}</p>
                </section>
                <article class="btns-historial-pedidos">
                    <button type="submit" id="btnConfirmarPedido" class="btn-Confirmar-Pedido">Confirmar compra</button>
                    <article class="cont-soporte">
                        <a href="{{ url('contacto') }}">
                            <p>Soporte</p>
                            <img src="{{ asset('img/headset-solid.svg') }}" alt="Icono de soporte">
                        </a>
                    </article>
                </article>
            </article>
        </article>
    @empty
        <p>No tienes pedidos pendientes.</p>
    @endforelse
</section>
</article>

{{-- Scripts --}}
<script src="{{ asset('js/nav-bar.js') }}"></script>
<script src="{{ asset('js/carrito.js') }}"></script>
<script src="{{ asset('js/notificaciones.js') }}"></script>
<script src="{{ asset('js/historialPedidos.js') }}"></script>
</x-app-layout>