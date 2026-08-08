<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\CustomerAddresses\CustomerAddresses;
use App\Livewire\Admin\AutoRepairManagement\CustomerAddresses\Create;
use App\Livewire\Admin\AutoRepairManagement\CustomerAddresses\Edit;
Route::prefix('auto-repair-management/customer-addresses')->group(function () {
    Route::get('/', CustomerAddresses::class)->name('admin.auto-repair-management.customer-addresses.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.customer-addresses.create');
    Route::get('/{' . 'customerAddress' . '}/edit', Edit::class)->name('admin.auto-repair-management.customer-addresses.edit');
});