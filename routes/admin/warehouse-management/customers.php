<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Customers\Customers;
use App\Livewire\Admin\WarehouseManagement\Customers\Create;
use App\Livewire\Admin\WarehouseManagement\Customers\Edit;
Route::prefix('warehouse-management/customers')->group(function () {
    Route::get('/', Customers::class)->name('admin.warehouse-management.customers.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.customers.create');
    Route::get('/{' . 'customer' . '}/edit', Edit::class)->name('admin.warehouse-management.customers.edit');
});