<?php
use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ClienteController;
use App\Http\Controllers\Roles\TenderoController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ContactoController;
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
    Route::post('/store/{store}/unfavorite', [FavoriteController::class, 'unfavorite'])->name('store.unfavorite');
    Route::post('/store/{store}/favorite', [FavoriteController::class, 'favorite'])->name('store.favorite');  

    Route::post('/detallesTienda/{id}', [ClienteController::class, 'detallesTienda'])->middleware('role:cliente')->name('detallesTienda');
    Route::post('/product/{id}/{idTienda}', [ClienteController::class, 'product'])->middleware('role:cliente')->name('product');
    Route::post('/busquedaTienda', [ClienteController::class, 'busquedaTienda'])->middleware('role:cliente')->name('busquedaTienda');
    Route::post('/pedido/agregar', [ClienteController::class, 'agregarProducto'])->name('cliente.pedido.agregar');

    Route::delete('/cliente/pedido/eliminar/{order}', [ClienteController::class, 'eliminarOrden'])->name('cliente.pedido.eliminar');

    
    Route::get('/cliente/pedido/detalle/{order}', [ClienteController::class, 'verDetalle'])->name('cliente.pedido.detalle');
    Route::post('/cliente/confirmar-pedido', [ClienteController::class, 'confirmarPedido'])->name('cliente.confirmarPedido');


    Route::get('/perfil', [ClienteController::class, 'perfil'])->middleware('role:cliente')->name('perfil');
    Route::put('updateUser', [ClienteController::class, 'updateUser'])->name('updateUser');
    Route::post('updatePassword', [ClienteController::class, 'updatePassword'])->name('updatePassword');

    Route::post('/actualizar-cantidad/{id}', [ClienteController::class, 'actualizarCantidad']);


    Route::get('/historialPedidos', [ClienteController::class, 'historialPedidos'])->middleware('role:cliente')->name('historialPedidos');

    Route::get('/homeTendero', [TenderoController::class, 'index'])->middleware('role:tendero')->name('homeTendero');

    Route::get('/homeAdmin', [AdminController::class, 'index'])->middleware('role:admin')->name('homeAdmin');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
