<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ECommerce\Products\Products;
use App\Livewire\Admin\ECommerce\Products\Create;
use App\Livewire\Admin\ECommerce\Products\Edit;
Route::prefix('e--commerce/products')->group(function () {
    Route::get('/', Products::class)->name('admin.e--commerce.products.index');
    Route::get('create', Create::class)->name('admin.e--commerce.products.create');
    Route::get('/{' . 'product' . '}/edit', Edit::class)->name('admin.e--commerce.products.edit');
});