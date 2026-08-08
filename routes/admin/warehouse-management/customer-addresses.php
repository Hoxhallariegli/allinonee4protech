<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\CustomerAddresses\CustomerAddresses;
use App\Livewire\Admin\WarehouseManagement\CustomerAddresses\Create;
use App\Livewire\Admin\WarehouseManagement\CustomerAddresses\Edit;
Route::prefix('warehouse-management/customer-addresses')->group(function () {
    Route::get('/', CustomerAddresses::class)->name('admin.warehouse-management.customer-addresses.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.customer-addresses.create');
    Route::get('/{' . 'customerAddress' . '}/edit', Edit::class)->name('admin.warehouse-management.customer-addresses.edit');
});