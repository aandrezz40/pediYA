<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/tendero/pedidos.css') }}">
    @endsection

    <main>
        <section class="cont-encabezado">
            <h2>Gestión de Pedidos</h2>
            <p>Administra los pedidos de tu tienda: {{ $store->name }}</p>
        </section>

        <section class="cont-filtros">
            <div class="filtros">
                <button class="filtro-btn active" data-estado="todos">Todos</button>
                <button class="filtro-btn" data-estado="pending">Pendientes</button>
                <button class="filtro-btn" data-estado="confirmed">Confirmados</button>
                <button class="filtro-btn" data-estado="preparing">En preparación</button>
                <button class="filtro-btn" data-estado="ready">Listos</button>
                <button class="filtro-btn" data-estado="delivered">Entregados</button>
                <button class="filtro-btn" data-estado="cancelled">Cancelados</button>
            </div>
        </section>

        <section class="cont-pedidos">
            @forelse ($orders as $order)
                <article class="card-pedido" data-estado="{{ $order->status }}">
                    <div class="pedido-header">
                        <div class="pedido-info">
                            <h3>Pedido #{{ $order->order_code }}</h3>
                            <p class="cliente">Cliente: {{ $order->user->name }}</p>
                            <p class="fecha">{{ $order->created_at->setTimezone('America/Bogota')->format('d/m/Y - h:i A') }}</p>
                        </div>
                        <div class="estado-actual">
                            <span class="estado-badge estado-{{ $order->status }}">
                                @switch($order->status)
                                    @case('pending')
                                        Pendiente
                                        @break
                                    @case('confirmed')
                                        Confirmado
                                        @break
                                    @case('preparing')
                                        En preparación
                                        @break
                                    @case('ready')
                                        Listo
                                        @break
                                    @case('delivered')
                                        Entregado
                                        @break
                                    @case('cancelled')
                                        Cancelado
                                        @break
                                    @default
                                        {{ ucfirst($order->status) }}
                                @endswitch
                            </span>
                        </div>
                    </div>

                    <div class="pedido-productos">
                        <h4>Productos:</h4>
                        <ul>
                            @foreach($order->orderItems as $item)
                                <li>
                                    <span class="producto-nombre">{{ $item->product_name }}</span>
                                    <span class="producto-cantidad">x{{ $item->quantity }}</span>
                                    <span class="producto-precio">${{ number_format($item->unit_price, 0) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if($order->customer_notes)
                        <div class="pedido-notas">
                            <h4>Notas del cliente:</h4>
                            <p>{{ $order->customer_notes }}</p>
                        </div>
                    @endif

                    <div class="pedido-footer">
                        <div class="pedido-total">
                            <strong>Total: ${{ number_format($order->total_amount, 0) }}</strong>
                        </div>
                        
                        @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                            <div class="pedido-acciones">
                                <select class="estado-selector" data-order-id="{{ $order->id }}">
                                    <option value="">Cambiar estado</option>
                                    @if($order->status === 'pending')
                                        <option value="confirmed">Confirmar pedido</option>
                                        <option value="cancelled">Cancelar pedido</option>
                                    @elseif($order->status === 'confirmed')
                                        <option value="preparing">Comenzar preparación</option>
                                        <option value="cancelled">Cancelar pedido</option>
                                    @elseif($order->status === 'preparing')
                                        <option value="ready">Marcar como listo</option>
                                        <option value="cancelled">Cancelar pedido</option>
                                    @elseif($order->status === 'ready')
                                        <option value="delivered">Marcar como entregado</option>
                                    @endif
                                </select>
                            </div>
                        @endif
                    </div>
                </article>
            @empty
                <div class="no-pedidos">
                    <p>No tienes pedidos activos en este momento.</p>
                </div>
            @endforelse
        </section>
    </main>

    @section('scripts')
        <script src="{{ asset('js/tendero/pedidos.js') }}"></script>
    @endsection
</x-app-layout> 