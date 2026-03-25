<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return app(ShopController::class)->index();
    }
    return view('landing');
})->name('home');
Route::get('/product/{product}', [ShopController::class, 'show'])->name('product.show');
Route::post('/cart/add/{product}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::post('/cart/remove/{product}', [ShopController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->isAdmin()) {
        return view('dashboard', ['role' => 'Gerente']);
    }

    if ($user->isEmployee()) {
        return view('dashboard', ['role' => 'Empleado']);
    }

    return view('dashboard', ['role' => 'Cliente']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
