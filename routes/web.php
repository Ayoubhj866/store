<?php

use App\Livewire\Admin\ProductsManagement;
use App\Livewire\ProductsListe;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductsListe::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/products', ProductsManagement::class)->name('products.management')->lazy();
});
