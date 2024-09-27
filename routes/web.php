<?php

use App\Livewire\Admin\ProductsManagement;
use App\Livewire\CartContent;
use App\Livewire\Checkout;
use App\Livewire\OrdersList;
use App\Livewire\OrderTracker;
use App\Livewire\ProductsListe;
use App\Livewire\ShowProduct;
use App\Livewire\WishlistItems;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductsListe::class)->name('home')->lazy();

Route::middleware('auth')->group(function () {

    // ************* about cart ********************
    Route::get('cart', CartContent::class)->name('cart-content');
    Route::get('checkout', Checkout::class)->name('checkout');
    Route::get('order/tracker/{order:uuid}', OrderTracker::class)->name('order-tracker');
    Route::get('/orders', OrdersList::class)->name('orders-list')->lazy();

    // ************* about wishlist ********************
    Route::get('/wishlist', WishlistItems::class)->name('wishlist-items')->lazy();

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
