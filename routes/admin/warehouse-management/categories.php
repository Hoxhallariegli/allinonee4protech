<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Categories\Categories;
use App\Livewire\Admin\WarehouseManagement\Categories\Create;
use App\Livewire\Admin\WarehouseManagement\Categories\Edit;
Route::prefix('warehouse-management/categories')->group(function () {
    Route::get('/', Categories::class)->name('admin.warehouse-management.categories.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.categories.create');
    Route::get('/{' . 'category' . '}/edit', Edit::class)->name('admin.warehouse-management.categories.edit');
});