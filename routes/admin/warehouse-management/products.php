<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Products\Products;
use App\Livewire\Admin\WarehouseManagement\Products\Create;
use App\Livewire\Admin\WarehouseManagement\Products\Edit;
Route::prefix('warehouse-management/products')->group(function () {
    Route::get('/', Products::class)->name('admin.warehouse-management.products.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.products.create');
    Route::get('/{' . 'product' . '}/edit', Edit::class)->name('admin.warehouse-management.products.edit');
});