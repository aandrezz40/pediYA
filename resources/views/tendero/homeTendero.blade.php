<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/tendero/homeTendero.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tendero/principalTendero.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @endsection

    <main class="main-principal-tendero">
        <!-- Mensajes de sesión -->
        @if(session('success'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong><br>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <strong>Error:</strong><br>
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning">
                <strong>Advertencia:</strong><br>
                {{ session('warning') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <strong>Error:</strong><br>
                {{ session('error') }}
            </div>
        @endif

        @if(isset($statusMessage))
            <div class="alert alert-error store-status-alert">
                <strong>Estado de Tienda:</strong><br>
                {{ $statusMessage }}
            </div>
        @endif

        <section class="cont-encabezado-principal-tendero">
            <article class="cont-titulo-encabezado-tendero">
                <h1 class="titulo-encabezado-tendero">¡Hola, {{ auth()->user()->name }}!</h1>
                <h3>Bienvenido al panel de control</h3>
            </article>
            <article class="cont-check-estado-tienda">
                @if($store->is_active && $store->status === 'approved')
                    <label for="checkboxEstadoTienda">
                        <p id="mensajeEstadoTienda">
                            Tu tienda está actualmente {{ $store->is_open ? 'abierta' : 'cerrada' }}
                        </p>
                        <input type="checkbox" id="checkboxEstadoTienda" class="checkbox" 
                               {{ $store->is_open ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                @else
                    <div class="disabled-store-status">
                        <p>Estado de tienda: <span class="status-badge {{ $store->status }}">{{ ucfirst($store->status) }}</span></p>
                        <p class="status-message">No puedes cambiar el estado de tu tienda en este momento.</p>
                    </div>
                @endif
            </article>
        </section>

        <section class="cont-botones-principal-tendero">
            @if($store->is_active && $store->status === 'approved')
                <a href="{{ route('tendero.pedidos') }}" class="btn-accion-tendero">
                    <img src="{{ asset('img/factura.svg') }}" alt="">
                    <article class="info-accion">
                        <h4>Ver solicitudes de pedido</h4>
                        <p>Gestiona los pedidos pendientes y en proceso</p>
                    </article>
                </a>

                <a href="#" class="btn-accion-tendero" id="btnGestionarProductos">
                    <img src="{{ asset('img/dairy-product.svg') }}" alt="">
                    <article class="info-accion">
                        <h4>Crear producto</h4>
                        <p>Gestiona tu nuevo producto</p>
                    </article>
                </a>

                <a href="{{ url('/perfil') }}" class="btn-accion-tendero">
                    <img src="{{ asset('img/logo-v1.1.png') }}" alt="">
                    <article class="info-accion">
                        <h4>Configurar tienda</h4>
                        <p>Modifica horarios y datos de contacto</p>
                    </article>
                </a>
            @else
                <div class="disabled-actions-message">
                    <p>Las funcionalidades de gestión están deshabilitadas debido al estado de tu tienda.</p>
                    <p>Contacta al administrador para más información.</p>
                </div>
            @endif
        </section>

        <section class="cont-vista-principal-productos">
            <div class="header-productos">
                <h3>Productos de tu tienda</h3>
            </div>
            
            @if($store->is_active && $store->status === 'approved')
                <!-- Filtros de categorías -->
                <div class="cont-categorias-filtro">
                    <button type="button" class="btn-categoria-filtro active" data-category-id="0">Todos</button>
                    @foreach($store->category as $category)
                        <button type="button" class="btn-categoria-filtro" data-category-id="{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                    <button class="btn-crear-categoria" id="btnCrearCategoria" onclick="abrirModalCategoria()">
                        <img src="{{ asset('img/plus.svg') }}" alt="+" style="width: 16px; height: 16px;">
                    </button>
                </div>
            @else
                <div class="disabled-products-message">
                    <p>La gestión de productos está deshabilitada debido al estado de tu tienda.</p>
                </div>
            @endif

            @if($store->is_active && $store->status === 'approved')
                @if($store->product->count() > 0)
                    <div class="cont-cards-productos-tendero">
                        @foreach($store->product as $product)
                            <article class="card-producto-tendero" data-category-id="{{ $product->category_id ?? 0 }}">
                                <section class="cont-img-producto-tendero">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                    <span class="estado-producto-badge {{ $product->is_available ? 'disponible' : 'agotado' }}">
                                        {{ $product->is_available ? 'Disponible' : 'Agotado' }}
                                    </span>
                                </section>
                                <section class="cont-info-producto-tendero">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="descripcion-producto-tendero">{{ $product->description ?? 'Sin descripción' }}</p>
                                    <p class="categoria-producto-tendero">{{ $product->category->name ?? 'Sin categoría' }}</p>
                                    <p class="precio-producto-tendero">${{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="stock-producto-tendero">Stock: {{ $product->stock ?? 0 }}</p>
                                    <article class="cont-acciones-producto-tendero">
                                        <button class="btn-editar-producto" data-product-id="{{ $product->id }}">
                                            Editar
                                        </button>
                                        <button type="button" class="btn-eliminar-producto" data-product-id="{{ $product->id }}">
                                            Eliminar
                                        </button>
                                    </article>
                                </section>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="sin-productos">
                        <p>No tienes productos registrados aún.</p>
                        <button class="btn-agregar-producto" id="btnAgregarProducto" onclick="abrirModalAgregar()">
                            Agregar primer producto
                        </button>
                    </div>
                @endif
            @endif

            @if($store->is_active && $store->status === 'approved')
                <!-- Sección de categorías disponibles -->
                <div class="categorias-disponibles">
                    <h4>Categorías disponibles en tu tienda:</h4>
                    @if($store->category->count() > 0)
                        <div class="lista-categorias">
                            @foreach($store->category as $category)
                                <span class="categoria-tag">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="sin-categorias">No tienes categorías creadas. Crea una categoría para organizar mejor tus productos.</p>
                    @endif
                </div>
            @endif
        </section>

        <!-- Modal para crear categorías -->
        <div id="modalCategoria" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Crear Nueva Categoría</h2>
                <form id="formCategoria" action="{{ route('tendero.crearCategoria') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="form-group">
                        <label for="nombreCategoria">Nombre de la categoría:</label>
                        <input type="text" id="nombreCategoria" name="name" required maxlength="255">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-cancelar">Cancelar</button>
                        <button type="submit" class="btn-guardar">Crear Categoría</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal para agregar/editar productos -->
        <div id="modalProducto" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="modalTitulo">Agregar Producto</h2>
                <form id="formProducto" action="{{ route('tendero.agregarProducto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="productoId" name="producto_id">
                    <input type="hidden" name="_method" value="POST">
                    
                    <div class="form-group">
                        <label for="nombreProducto">Nombre del producto:</label>
                        <input type="text" id="nombreProducto" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcionProducto">Descripción:</label>
                        <textarea id="descripcionProducto" name="description" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="precioProducto">Precio:</label>
                        <input type="number" id="precioProducto" name="price" min="0" step="100" required>
                    </div>



                    <div class="form-group">
                        <label for="categoriaProducto">Categoría:</label>
                        <select id="categoriaProducto" name="category_id">
                            <option value="">Seleccionar categoría</option>
                            @foreach($store->category as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stockProducto">Stock disponible:</label>
                        <input type="number" id="stockProducto" name="stock" min="0" value="0">
                    </div>

                    <div class="form-group">
                        <label for="disponibleProducto">
                            <input type="checkbox" id="disponibleProducto" name="is_available" value="1" checked>
                            Producto disponible
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="imagenProducto">Imagen del producto:</label>
                        <input type="file" id="imagenProducto" name="image" accept="image/*">
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancelar">Cancelar</button>
                        <button type="submit" class="btn-guardar">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @section('scripts')
        <script src="{{ asset('js/tendero/principalTendero.js') }}"></script>
        <script src="{{ asset('js/tendero/storeStatusHandler.js') }}"></script>
    @endsection
</x-app-layout>
 