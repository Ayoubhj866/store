<?php

use App\Livewire\Admin\ProductsManagement;
use App\Livewire\CartContent;
use App\Livewire\ProductsListe;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductsListe::class)->name('home')->lazy();

Route::middleware('auth')->group(function () {
    Route::get('cart', CartContent::class)->name('cart-content');

    // Admin routes
    Route::get('/products', ProductsManagement::class)->name('products.management')->lazy();

    //users routes
    Route::get('/{product:name}', ShowProduct::class)->name('showProduct')->lazy();
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
