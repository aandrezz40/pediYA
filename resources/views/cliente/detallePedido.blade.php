<x-app-layout>
@section('styles')
        <link rel="stylesheet" href="{{ asset('css/users/detallesPedidos.css') }}">
@endsection
    <main>
        <section class="cont-encabezado">
            <h2>Confirmación de pedido</h2>
        </section>

        <section class="cont-alerta">
            <h3>Información importante</h3>
            <p>Tu solicitud de pedido será enviada a la tienda. PediYÁ no gestiona los envíos a domicilio ni los pagos. Si la tienda ofrece domicilio (verifica en su perfil), debes contactarla directamente. El pago total se realiza directamente a la tienda al recoger el pedido o al recibir el domicilio.</p>
        </section>

        <section class="titulos">
            <h2>Resumen del pedido</h2>
            <h2 class="nombre-tienda">{{ $order->store->name }}</h2>
        </section>

        <section class="cont-productos-detalles">
            @foreach($order->orderItems as $item)
                <article class="producto">
                    <article class="cont-img">
                        <img src="{{ $item->product ? $item->product->image_url : asset('img/rice-ball_.png') }}" alt="{{ $item->product_name }}">
                    </article>
                    <article class="cont-info-prducto">
                        <h3>{{ $item->product_name }}</h3>
                        <p class="descripcion-producto">Producto sin descripción</p>
                        <p class="precio-producto">Precio: ${{ number_format($item->unit_price, 2) }}</p>
                    </article>
                    <article class="cont-cantidad">
                        <p>{{ $item->quantity }}</p>
                    </article>
                </article>
            @endforeach
        </section>

        <section class="cont-total">
            <h3>Total a pagar</h3>
            <p>${{ number_format($order->orderItems->sum('subtotal'), 2) }}</p>
        </section>

<form class="form-cont-nota" action="{{ route('cliente.confirmarPedido') }}" method="POST">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    
    <section class="cont-nota">
        <h3>Notas para el tendero</h3>
        <textarea name="customer_notes" placeholder="Agrega instrucciones especiales para el tendero (coordinación de domicilio, método de pago preferido, etc.)"></textarea>
    </section>

    <section class="cont-btns">
        <button type="submit" class="btn-confirmar-pedido">Confirmar pedido</button>
    </section>
</form>

        <dialog id="modalDetallesPedido">
            <section class="cont-info-modal">
                <img src="{{ asset('img/circle-check-solid.svg') }}" alt="">
                <p>Tu solicitud de pedido ha sido confirmada</p>
            </section>
        </dialog>
    </main>


    
    @section('scripts')

    @endsection

</x-app-layout>

