
            @foreach($orders as $order)
                <article class="card-carrito" data-order-id="{{ $order->id }}">
                    <section class="cont-acciones">
                        <h3 class="nombreTienda"><span></span>{{ $order->store->name }}</h3>
                        <a href="{{ route('cliente.pedido.detalle', ['order' => $order->id]) }}" class="btn-ver-detalle">✔</a>
                        <img class="desplegarProducto esconderProducto" src="{{ asset('img/arrow-up-circle.svg') }}" alt="Desplegar producto">
                        <img class="eliminarProducto" src="{{ asset('img/x-fill-12_.png') }}" alt="Eliminar producto">
                    </section>

                    <section class="cont-productos oculto">
                        @foreach ($order->orderItems as $item)
                            <section class="cont-imagen-producto" id="cont-imagen-producto">
                                <section class="cont-datos-producto">
                                    <img src="{{ asset('img/rice-ball_.png') }}" alt="">
                                    <article class="contDescripcion">
                                        <h3 class="nombreProducto">{{ $item->product_name }}</h3>
                                        <article class="cont-cantidad">
                                            <p class="precioProducto">{{ $item->unit_price }}</p>

                                            <form class="cont-cantidad-producto" data-id="{{ $item->id }}">
                                                @csrf
                                                <button type="button" class="btn-confirmar-cantidad">✔</button>
                                                <article class="cont-boton-cantidad">
                                                    <button type="button" class="disminuir-cantidad">-</button>
                                                    <span class="cantidad-producto" contenteditable="false">{{ $item->quantity }}</span>
                                                    <button type="button" class="aumentar-cantidad">+</button>
                                                </article>
                                                <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                                            </form>
                                        </article>
                                    </article>
                                </section>
                                <article class="cont-confirmar">
                                    <p>Subtotal: <span>{{ $item->subtotal }}</span></p>
                                </article>
                            </section>
                        @endforeach
                    </section>
                </article>
            @endforeach

            
