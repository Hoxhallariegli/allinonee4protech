<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Warehouses\Warehouses;
use App\Livewire\Admin\WarehouseManagement\Warehouses\Create;
use App\Livewire\Admin\WarehouseManagement\Warehouses\Edit;
Route::prefix('warehouse-management/warehouses')->group(function () {
    Route::get('/', Warehouses::class)->name('admin.warehouse-management.warehouses.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.warehouses.create');
    Route::get('/{' . 'warehouse' . '}/edit', Edit::class)->name('admin.warehouse-management.warehouses.edit');
});