<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Customers\Customers;
use App\Livewire\Admin\AutoRepairManagement\Customers\Create;
use App\Livewire\Admin\AutoRepairManagement\Customers\Edit;
Route::prefix('auto-repair-management/customers')->group(function () {
    Route::get('/', Customers::class)->name('admin.auto-repair-management.customers.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.customers.create');
    Route::get('/{' . 'customer' . '}/edit', Edit::class)->name('admin.auto-repair-management.customers.edit');
});