<?php


use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\LProductos;

Route::view('/', 'welcome');

// ✅ Ruta al dashboard que redirige a Producto
Route::get('/dashboard', function () {
    return redirect()->route('Producto');
})->middleware(['auth'])->name('dashboard');

// ✅ Rutas protegidas para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('Producto', LProductos::class)->name('Producto');
    
    Route::redirect('settings', 'settings/profile');
    
    Route::view('profile', 'profile')->name('profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
