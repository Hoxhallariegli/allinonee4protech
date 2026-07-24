<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Products\Products;
use App\Livewire\Admin\Products\Create;
use App\Livewire\Admin\Products\Edit;

Route::prefix('products')->group(function () {
    Route::get('/', Products::class)->name('admin.products.index')->middleware('can:view_products');
    Route::get('create', Create::class)->name('admin.products.create')->middleware('can:add_products');
    Route::get('{product}/edit', Edit::class)->name('admin.products.edit')->middleware('can:edit_products');
});
