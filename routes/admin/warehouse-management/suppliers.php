<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Suppliers\Suppliers;
use App\Livewire\Admin\WarehouseManagement\Suppliers\Create;
use App\Livewire\Admin\WarehouseManagement\Suppliers\Edit;
Route::prefix('warehouse-management/suppliers')->group(function () {
    Route::get('/', Suppliers::class)->name('admin.warehouse-management.suppliers.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.suppliers.create');
    Route::get('/{' . 'supplier' . '}/edit', Edit::class)->name('admin.warehouse-management.suppliers.edit');
});