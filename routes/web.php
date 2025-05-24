<?php
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
})->middleware(['auth', 'verified', 'role:cliente'])->name('homeCliente');

Route::get('/homeTendero', function () {
    return view('tendero.homeTendero');
})->middleware(['auth', 'verified', 'role:tendero'])->name('homeTendero');

Route::get('/homeAdmin', function () {
    return view('admin.homeAdmin');
})->middleware(['auth', 'verified', 'role:admin'])->name('homeAdmin');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
