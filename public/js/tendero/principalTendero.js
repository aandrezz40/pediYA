// Configuración global
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Funciones de utilidad
function showAlert(message, type = 'success') {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;
    
    // Agregar botón de cerrar
    const closeButton = document.createElement('button');
    closeButton.innerHTML = '&times;';
    closeButton.style.cssText = `
        position: absolute;
        top: 5px;
        right: 10px;
        background: none;
        border: none;
        color: inherit;
        font-size: 20px;
        cursor: pointer;
        font-weight: bold;
    `;
    closeButton.onclick = function() {
        alert.style.animation = 'slideOutRight 0.5s ease-out';
        setTimeout(() => {
            if (alert.parentNode) {
                alert.parentNode.removeChild(alert);
            }
        }, 500);
    };
    
    alert.style.position = 'relative';
    alert.appendChild(closeButton);
    
    document.body.appendChild(alert);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        if (alert.parentNode) {
            alert.style.animation = 'slideOutRight 0.5s ease-out';
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }
    }, 5000);
}

function setLoadingState(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.textContent = 'Guardando...';
        button.style.opacity = '0.6';
    } else {
        button.disabled = false;
        button.textContent = button.getAttribute('data-original-text') || 'Guardar';
        button.style.opacity = '1';
    }
}

// Funciones para modales
function abrirModalAgregar() {
    const modal = document.getElementById('modalProducto');
    const titulo = document.getElementById('modalTitulo');
    const form = document.getElementById('formProducto');
    const submitBtn = form.querySelector('.btn-guardar');
    
    titulo.textContent = 'Agregar Producto';
    form.reset();
    form.action = '/tendero/agregar-producto';
    form.method = 'POST';
    
    // Limpiar campos
    document.getElementById('productoId').value = '';
    document.getElementById('nombreProducto').value = '';
    document.getElementById('descripcionProducto').value = '';
    document.getElementById('precioProducto').value = '';
    document.getElementById('categoriaProducto').value = '';
    document.getElementById('stockProducto').value = '0';
    document.getElementById('disponibleProducto').checked = true;
    document.getElementById('imagenProducto').value = '';
    
    // Limpiar preview de imagen
    const preview = document.querySelector('.image-preview');
    if (preview) preview.remove();
    
    modal.style.display = 'block';
    submitBtn.setAttribute('data-original-text', 'Guardar Producto');
}

function abrirModalEditar(productId) {
    const modal = document.getElementById('modalProducto');
    const titulo = document.getElementById('modalTitulo');
    const form = document.getElementById('formProducto');
    const submitBtn = form.querySelector('.btn-guardar');
    
    titulo.textContent = 'Editar Producto';
    form.action = '/tendero/editar-producto';
    form.method = 'POST';
    
    // Cargar datos del producto
    fetch(`/tendero/producto/${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const product = data.product;
                document.getElementById('productoId').value = product.id;
                document.getElementById('nombreProducto').value = product.name;
                document.getElementById('descripcionProducto').value = product.description || '';
                document.getElementById('precioProducto').value = product.price;
                document.getElementById('categoriaProducto').value = product.category_id || '';
                document.getElementById('stockProducto').value = product.stock || 0;
                document.getElementById('disponibleProducto').checked = product.is_available;
                
                // Mostrar imagen actual si existe
                if (product.image_url) {
                    mostrarPreviewImagen(product.image_url);
                }
            } else {
                showAlert(data.message || 'Error al cargar el producto', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error al cargar el producto', 'error');
        });
    
    modal.style.display = 'block';
    submitBtn.setAttribute('data-original-text', 'Actualizar Producto');
}

function cerrarModal() {
    const modal = document.getElementById('modalProducto');
    modal.style.display = 'none';
}

function abrirModalCategoria() {
    const modal = document.getElementById('modalCategoria');
    const form = document.getElementById('formCategoria');
    form.reset();
    modal.style.display = 'block';
}

function cerrarModalCategoria() {
    const modal = document.getElementById('modalCategoria');
    modal.style.display = 'none';
}

// Función para mostrar preview de imagen
function mostrarPreviewImagen(fileOrUrl) {
    const preview = document.querySelector('.image-preview') || document.createElement('div');
    preview.className = 'image-preview';
    
    if (typeof fileOrUrl === 'string') {
        // Es una URL (edición)
        preview.innerHTML = `<img src="${fileOrUrl}" alt="Preview">`;
    } else {
        // Es un archivo (nuevo)
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(fileOrUrl);
    }
    
    const fileInput = document.getElementById('imagenProducto');
    if (!document.querySelector('.image-preview')) {
        fileInput.parentNode.appendChild(preview);
    }
}

// Manejo de formulario de productos
document.addEventListener('DOMContentLoaded', function() {
    const formProducto = document.getElementById('formProducto');
    const formCategoria = document.getElementById('formCategoria');
    
    // Preview de imagen
    const imagenInput = document.getElementById('imagenProducto');
    if (imagenInput) {
        imagenInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                mostrarPreviewImagen(file);
            } else {
                const preview = document.querySelector('.image-preview');
                if (preview) preview.remove();
            }
        });
    }
    
    // Submit del formulario de productos
    if (formProducto) {
        formProducto.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('.btn-guardar');
            const isEditing = this.action.includes('/editar-producto');
            
            // Si no es edición, remover el campo producto_id
            if (!isEditing) {
                formData.delete('producto_id');
            }
            
            setLoadingState(submitBtn, true);
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                setLoadingState(submitBtn, false);
                
                if (data.success) {
                    showAlert(data.message || (isEditing ? 'Producto actualizado exitosamente' : 'Producto creado exitosamente'));
                    cerrarModal();
                    
                    // Si es un producto nuevo, agregarlo dinámicamente
                    if (!isEditing && data.product) {
                        agregarProductoAlDOM(data.product);
                    } else if (isEditing && data.product) {
                        // Si es edición, actualizar el producto existente
                        actualizarProductoEnDOM(data.product);
                    }
                } else {
                    showAlert(data.message || 'Error al procesar la solicitud', 'error');
                }
            })
            .catch(error => {
                setLoadingState(submitBtn, false);
                console.error('Error:', error);
                showAlert('Error de conexión', 'error');
            });
        });
    }
    
    // Submit del formulario de categorías
    if (formCategoria) {
        formCategoria.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('.btn-guardar');
            
            setLoadingState(submitBtn, true);
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                setLoadingState(submitBtn, false);
                
                if (data.success) {
                    showAlert(data.message || 'Categoría creada exitosamente');
                    cerrarModalCategoria();
                    
                    // Agregar la nueva categoría al filtro dinámicamente
                    if (data.category) {
                        agregarCategoriaAlFiltro(data.category);
                    }
                } else {
                    showAlert(data.message || 'Error al crear la categoría', 'error');
                }
            })
            .catch(error => {
                setLoadingState(submitBtn, false);
                console.error('Error:', error);
                showAlert('Error de conexión', 'error');
            });
        });
    }
    
    // Manejo de botones de cerrar modales
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        const closeBtn = modal.querySelector('.close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                if (modal.id === 'modalProducto') {
                    cerrarModal();
                } else if (modal.id === 'modalCategoria') {
                    cerrarModalCategoria();
                }
            });
        }
        
        // Cerrar modal haciendo clic fuera
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                if (modal.id === 'modalProducto') {
                    cerrarModal();
                } else if (modal.id === 'modalCategoria') {
                    cerrarModalCategoria();
                }
            }
        });
    });
    
    // Manejo de botones cancelar
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-cancelar')) {
            const modal = e.target.closest('.modal');
            if (modal) {
                if (modal.id === 'modalProducto') {
                    cerrarModal();
                } else if (modal.id === 'modalCategoria') {
                    cerrarModalCategoria();
                }
            }
        }
    });
    
    // Manejo de botones editar producto
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-editar-producto')) {
            const productId = e.target.getAttribute('data-product-id');
            abrirModalEditar(productId);
        }
    });
    
    // Manejo del botón gestionar productos
    const btnGestionar = document.getElementById('btnGestionarProductos');
    if (btnGestionar) {
        btnGestionar.addEventListener('click', function(e) {
            e.preventDefault();
            abrirModalAgregar();
        });
    }
    
                    // Manejo de eliminación de productos
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('btn-eliminar-producto')) {
                        e.preventDefault();
                        
                        if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
                            const productId = e.target.getAttribute('data-product-id');
                            
                            fetch(`/tendero/eliminar-producto/${productId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': CSRF_TOKEN,
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showAlert('Producto eliminado exitosamente');
                                    // Remover el elemento del DOM
                                    const productCard = e.target.closest('.card-producto-tendero');
                                    if (productCard) {
                                        productCard.style.animation = 'fadeOut 0.3s ease-out';
                                        setTimeout(() => {
                                            productCard.remove();
                                            
                                            // Verificar si no quedan productos
                                            const remainingProducts = document.querySelectorAll('.card-producto-tendero');
                                            if (remainingProducts.length === 0) {
                                                location.reload();
                                            }
                                        }, 300);
                                    }
                                } else {
                                    showAlert(data.message || 'Error al eliminar el producto', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showAlert('Error de conexión', 'error');
                            });
                        }
                    }
                });
    
    // Manejo de filtros de categorías
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-categoria-filtro')) {
            const categoryId = e.target.getAttribute('data-category-id');
            
            // Remover clase active de todos los botones
            document.querySelectorAll('.btn-categoria-filtro').forEach(b => b.classList.remove('active'));
            
            // Agregar clase active al botón clickeado
            e.target.classList.add('active');
            
            // Filtrar productos
            const productos = document.querySelectorAll('.card-producto-tendero');
            productos.forEach(producto => {
                const productCategoryId = producto.getAttribute('data-category-id');
                
                if (categoryId === '0' || productCategoryId === categoryId) {
                    producto.style.display = 'block';
                    producto.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    producto.style.display = 'none';
                }
            });
        }
    });
    
    // Manejo del estado de la tienda
    const checkboxEstado = document.getElementById('checkboxEstadoTienda');
    const mensajeEstado = document.getElementById('mensajeEstadoTienda');
    
    if (checkboxEstado && mensajeEstado) {
        checkboxEstado.addEventListener('change', function() {
            const isOpen = this.checked;
            mensajeEstado.textContent = `Tu tienda está actualmente ${isOpen ? 'abierta' : 'cerrada'}`;
            
            fetch('/tendero/cambiar-estado-tienda', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({
                    is_open: isOpen
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(`Tienda ${isOpen ? 'abierta' : 'cerrada'} exitosamente`);
                } else {
                    showAlert('Error al cambiar el estado de la tienda', 'error');
                    // Revertir el checkbox
                    this.checked = !isOpen;
                    mensajeEstado.textContent = `Tu tienda está actualmente ${!isOpen ? 'abierta' : 'cerrada'}`;
                }
            })
            .catch(error => {
                console.error('Error al actualizar estado:', error);
                showAlert('Error de conexión', 'error');
                // Revertir el checkbox
                this.checked = !isOpen;
                mensajeEstado.textContent = `Tu tienda está actualmente ${!isOpen ? 'abierta' : 'cerrada'}`;
            });
        });
    }
});

// Funciones para actualizar el DOM dinámicamente
function agregarProductoAlDOM(product) {
    const contenedor = document.querySelector('.cont-cards-productos-tendero');
    if (!contenedor) return;
    
    const productHTML = `
        <article class="card-producto-tendero" data-category-id="${product.category_id || 0}">
            <section class="cont-img-producto-tendero">
                <img src="${product.image_url || '/img/default-product.jpg'}" alt="${product.name}">
                <span class="estado-producto-badge ${product.is_available ? 'disponible' : 'agotado'}">
                    ${product.is_available ? 'Disponible' : 'Agotado'}
                </span>
            </section>
            <section class="cont-info-producto-tendero">
                <h3>${product.name}</h3>
                <p class="descripcion-producto-tendero">${product.description || 'Sin descripción'}</p>
                <p class="categoria-producto-tendero">${product.category ? product.category.name : 'Sin categoría'}</p>
                <p class="precio-producto-tendero">$${parseInt(product.price).toLocaleString()}</p>
                <p class="stock-producto-tendero">Stock: ${product.stock || 0}</p>
                <article class="cont-acciones-producto-tendero">
                    <button class="btn-editar-producto" data-product-id="${product.id}">
                        Editar
                    </button>
                    <button type="button" class="btn-eliminar-producto" data-product-id="${product.id}">
                        Eliminar
                    </button>
                </article>
            </section>
        </article>
    `;
    
    contenedor.insertAdjacentHTML('beforeend', productHTML);
    
    // Obtener el filtro activo actual
    const filtroActivo = document.querySelector('.btn-categoria-filtro.active');
    const categoriaActiva = filtroActivo ? filtroActivo.getAttribute('data-category-id') : '0';
    
    // Obtener la card recién agregada
    const nuevaCard = contenedor.lastElementChild;
    
    // Aplicar el filtro actual a la nueva card
    if (categoriaActiva === '0' || nuevaCard.getAttribute('data-category-id') === categoriaActiva) {
        nuevaCard.style.display = 'block';
        nuevaCard.style.animation = 'fadeIn 0.3s ease-in';
    } else {
        nuevaCard.style.display = 'none';
    }
    
    // Remover mensaje de "sin productos" si existe
    const sinProductos = document.querySelector('.sin-productos');
    if (sinProductos) {
        sinProductos.remove();
    }
}

function actualizarProductoEnDOM(product) {
    // Buscar la card por el botón de editar que contiene el product ID
    const editButton = document.querySelector(`.btn-editar-producto[data-product-id="${product.id}"]`);
    
    if (!editButton) {
        return;
    }
    
    const productCard = editButton.closest('.card-producto-tendero');
    
    if (!productCard) {
        return;
    }
    
    // Actualizar datos del producto
    const nameElement = productCard.querySelector('h3');
    const descElement = productCard.querySelector('.descripcion-producto-tendero');
    const catElement = productCard.querySelector('.categoria-producto-tendero');
    const priceElement = productCard.querySelector('.precio-producto-tendero');
    const stockElement = productCard.querySelector('.stock-producto-tendero');
    const imgElement = productCard.querySelector('img');
    const badgeElement = productCard.querySelector('.estado-producto-badge');
    
    if (nameElement) nameElement.textContent = product.name;
    if (descElement) descElement.textContent = product.description || 'Sin descripción';
    if (catElement) catElement.textContent = product.category ? product.category.name : 'Sin categoría';
    if (priceElement) priceElement.textContent = `$${parseInt(product.price).toLocaleString()}`;
    if (stockElement) stockElement.textContent = `Stock: ${product.stock || 0}`;
    if (imgElement) imgElement.src = product.image_url || '/img/default-product.jpg';
    if (badgeElement) {
        badgeElement.textContent = product.is_available ? 'Disponible' : 'Agotado';
        badgeElement.className = `estado-producto-badge ${product.is_available ? 'disponible' : 'agotado'}`;
    }
    
    // Actualizar data-category-id
    const categoriaAnterior = productCard.getAttribute('data-category-id');
    productCard.setAttribute('data-category-id', product.category_id || 0);
    
    // Obtener el filtro activo actual
    const filtroActivo = document.querySelector('.btn-categoria-filtro.active');
    const categoriaActiva = filtroActivo ? filtroActivo.getAttribute('data-category-id') : '0';
    
    // Si la categoría cambió, verificar si debe mostrarse o ocultarse
    if (categoriaAnterior !== (product.category_id || 0)) {
        if (categoriaActiva === '0' || productCard.getAttribute('data-category-id') === categoriaActiva) {
            productCard.style.display = 'block';
            productCard.style.animation = 'fadeIn 0.3s ease-in';
        } else {
            productCard.style.display = 'none';
        }
    }
}

function agregarCategoriaAlFiltro(category) {
    const contenedorFiltros = document.querySelector('.cont-categorias-filtro');
    if (!contenedorFiltros) return;
    
    // Crear el botón de filtro
    const botonFiltro = document.createElement('button');
    botonFiltro.type = 'button';
    botonFiltro.className = 'btn-categoria-filtro';
    botonFiltro.setAttribute('data-category-id', category.id);
    botonFiltro.textContent = category.name;
    
    // Insertar antes del botón de crear categoría
    const btnCrearCategoria = contenedorFiltros.querySelector('.btn-crear-categoria');
    if (btnCrearCategoria) {
        contenedorFiltros.insertBefore(botonFiltro, btnCrearCategoria);
    } else {
        contenedorFiltros.appendChild(botonFiltro);
    }
    
    // Agregar también a la sección de categorías disponibles
    const contenedorCategorias = document.querySelector('.lista-categorias');
    if (contenedorCategorias) {
        const categoriaTag = document.createElement('span');
        categoriaTag.className = 'categoria-tag';
        categoriaTag.textContent = category.name;
        contenedorCategorias.appendChild(categoriaTag);
    }
    
    // Remover mensaje de "sin categorías" si existe
    const sinCategorias = document.querySelector('.sin-categorias');
    if (sinCategorias) {
        sinCategorias.remove();
    }
}

// Funciones globales para usar desde el HTML
window.abrirModalAgregar = abrirModalAgregar;
window.cerrarModal = cerrarModal;
window.abrirModalCategoria = abrirModalCategoria;
window.cerrarModalCategoria = cerrarModalCategoria; 