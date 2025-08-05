<?php
use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ClienteController;
use App\Http\Controllers\Roles\TenderoController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarriosController;

use App\Models\Barrio;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/nosotros', function () {
    return view('sobre_nosotros');
});

    Route::get('/contacto', [ContactoController::class, 'contactanos_form'])->name('contacto');
    Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');

    // Rutas de notificaciones
    Route::middleware('auth')->group(function () {
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::patch('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
        Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');
    });



Route::get('/home', function () {
    $user = Auth::user();

    return match ($user->role) {
        'cliente' => redirect()->route('homeCliente'),
        'tendero' => redirect()->route('homeTendero'),
        'admin'   => redirect()->route('homeAdmin'),
        default   => abort(403, 'Acceso no autorizado'),
    };
})->middleware(['auth', 'verified'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/homeCliente', [ClienteController::class, 'index'])->middleware('role:cliente')->name('homeCliente');
    Route::post('/store/{store}/unfavorite', [FavoriteController::class, 'unfavorite'])->middleware('role:cliente')->name('store.unfavorite');
    Route::post('/store/{store}/favorite', [FavoriteController::class, 'favorite'])->middleware('role:cliente')->name('store.favorite');  

    Route::get('/detallesTienda/{id}', [ClienteController::class, 'detallesTienda'])->middleware('role:cliente')->name('detallesTienda');
    // Route::post('/product/{id}/{idTienda}', [ClienteController::class, 'product'])->middleware('role:cliente')->name('product');
    Route::post('/busquedaTienda', [ClienteController::class, 'busquedaTienda'])->middleware('role:cliente')->name('busquedaTienda');
    Route::get('/buscar-tiendas', [ClienteController::class, 'buscarTiendas'])->middleware('role:cliente')->name('buscar.tiendas');
    Route::post('/pedido/agregar', [ClienteController::class, 'agregarProducto'])->middleware('role:cliente')->name('cliente.pedido.agregar');

    Route::delete('/cliente/pedido/eliminar/{order}', [ClienteController::class, 'eliminarOrden'])->middleware('role:cliente')->middleware('role:cliente')->name('cliente.pedido.eliminar');

    
    Route::get('/cliente/pedido/detalle/{order}', [ClienteController::class, 'verDetalle'])->middleware('role:cliente')->name('cliente.pedido.detalle');
    Route::post('/cliente/confirmar-pedido', [ClienteController::class, 'confirmarPedido'])->middleware('role:cliente')->name('cliente.confirmarPedido');


    Route::get('/perfil', [ClienteController::class, 'perfil'])->name('perfil');
    Route::get('/tendero/perfil', [ClienteController::class, 'perfil'])->name('tendero.perfil');
    Route::put('updateUser', [ClienteController::class, 'updateUser'])->name('updateUser');
    Route::post('updatePassword', [ClienteController::class, 'updatePassword'])->name('updatePassword');

    Route::post('/actualizar-cantidad/{id}', [ClienteController::class, 'actualizarCantidad'])->middleware('role:cliente');


    Route::get('/historialPedidos', [ClienteController::class, 'historialPedidos'])->middleware('role:cliente')->name('historialPedidos');

    
    // Rutas del tendero que requieren tienda registrada
    Route::middleware(['role:tendero', 'tendero.store.registration'])->group(function () {
        Route::get('/homeTendero', [TenderoController::class, 'index'])->name('homeTendero');
    });

    // Rutas del tendero que requieren tienda activa y aprobada
    Route::middleware(['role:tendero', 'tendero.store.registration', 'tendero.store.status'])->group(function () {
        Route::get('/tendero/pedidos', [TenderoController::class, 'pedidos'])->name('tendero.pedidos');
        Route::get('/tendero/pedido/{order}', [TenderoController::class, 'verPedido'])->name('tendero.verPedido');
        Route::patch('/tendero/pedido/{order}/estado', [TenderoController::class, 'cambiarEstadoPedido'])->name('tendero.cambiarEstadoPedido');
        
        // Rutas para actualizar información de la tienda
        Route::post('/tendero/update-store-basic', [TenderoController::class, 'updateStoreBasicInfo'])->name('tendero.updateStoreBasic');
        Route::post('/tendero/update-store-schedule', [TenderoController::class, 'updateStoreSchedule'])->name('tendero.updateStoreSchedule');
        Route::post('/tendero/update-store-payment-methods', [TenderoController::class, 'updateStorePaymentMethods'])->name('tendero.updateStorePaymentMethods');
        
        // Rutas para gestión de productos
        Route::post('/tendero/agregar-producto', [TenderoController::class, 'agregarProducto'])->name('tendero.agregarProducto');
        Route::get('/tendero/producto/{product}', [TenderoController::class, 'obtenerProducto'])->name('tendero.obtenerProducto');
        Route::post('/tendero/editar-producto', [TenderoController::class, 'editarProducto'])->name('tendero.editarProducto');
        Route::delete('/tendero/eliminar-producto/{product}', [TenderoController::class, 'eliminarProducto'])->name('tendero.eliminarProducto');
        
        // Rutas para gestión de categorías
        Route::post('/tendero/crear-categoria', [TenderoController::class, 'crearCategoria'])->name('tendero.crearCategoria');
        
        // Ruta para cambiar estado de la tienda
        Route::post('/tendero/cambiar-estado-tienda', [TenderoController::class, 'cambiarEstadoTienda'])->name('tendero.cambiarEstadoTienda');
    });

    // Rutas del tendero para registro de tienda
    Route::middleware('role:tendero')->group(function () {
        Route::get('/tendero/registro-tienda', [TenderoController::class, 'registroTienda'])->name('tendero.registroTienda');
        Route::post('/tendero/registro-tienda', [TenderoController::class, 'storeRegistroTienda'])->name('tendero.storeRegistroTienda');
    });

    Route::get('/homeAdmin', [AdminController::class, 'index'])->middleware('role:admin')->name('homeAdmin');
    
    // Rutas para obtener datos de tiendas y usuarios
    Route::get('/admin/tienda/{id}', [AdminController::class, 'getTienda'])->middleware('role:admin')->name('admin.tienda.show');
    Route::get('/admin/usuario/{id}', [AdminController::class, 'getUsuario'])->middleware('role:admin')->name('admin.usuario.show');
    
    // Rutas para gestión de tiendas
    Route::post('/admin/tienda/{id}/aprobar', [AdminController::class, 'aprobarTienda'])->middleware('role:admin')->name('admin.tienda.aprobar');
    Route::post('/admin/tienda/{id}/desaprobar', [AdminController::class, 'desaprobarTienda'])->middleware('role:admin')->name('admin.tienda.desaprobar');
    Route::post('/admin/tienda/{id}/activar', [AdminController::class, 'activarTienda'])->middleware('role:admin')->name('admin.tienda.activar');
    Route::post('/admin/tienda/{id}/desactivar', [AdminController::class, 'desactivarTienda'])->middleware('role:admin')->name('admin.tienda.desactivar');
    
    // Rutas para gestión de usuarios
    Route::post('/admin/usuario/{id}/activar', [AdminController::class, 'activarUsuario'])->middleware('role:admin')->name('admin.usuario.activar');
    Route::post('/admin/usuario/{id}/desactivar', [AdminController::class, 'desactivarUsuario'])->middleware('role:admin')->name('admin.usuario.desactivar');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
