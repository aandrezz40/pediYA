<?php
use App\Http\Controllers\Roles\AdminController;
use App\Http\Controllers\Roles\ClienteController;
use App\Http\Controllers\Roles\TenderoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/nosotros', function () {
    return view('sobre_nosotros');
});

Route::get('/contacto', [ContactoController::class, 'contactanos_form'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');

Route::get('/homeCliente', function () {
    return view('cliente.homeCliente');
})->middleware(['auth', 'verified'])->name('homeCliente');

Route::get('/homeTendero', function () {
    return view('tendero.homeTendero');
})->middleware(['auth', 'verified', 'role:tendero'])->name('homeTendero');

Route::get('/homeAdmin', function () {
    return view('admin.homeAdmin');
})->middleware(['auth', 'verified', 'role:admin'])->name('homeAdmin');


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
    Route::get('/homeCliente', [ClienteController::class, 'index'])->name('homeCliente');
    Route::get('/homeTendero', [TenderoController::class, 'index'])->middleware('role:tendero')->name('homeTendero');
    Route::get('/homeAdmin', [AdminController::class, 'index'])->middleware('role:admin')->name('homeAdmin');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
