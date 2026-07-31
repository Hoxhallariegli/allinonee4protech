<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Sales\Sales;
use App\Livewire\Admin\WarehouseManagement\Sales\Create;
use App\Livewire\Admin\WarehouseManagement\Sales\Edit;
Route::prefix('warehouse-management/sales')->group(function () {
    Route::get('/', Sales::class)->name('admin.warehouse-management.sales.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.sales.create');
    Route::get('/{' . 'sale' . '}/edit', Edit::class)->name('admin.warehouse-management.sales.edit');
});