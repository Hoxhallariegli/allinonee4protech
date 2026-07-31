<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Suppliers\Suppliers;
use App\Livewire\Admin\AutoRepairManagement\Suppliers\Create;
use App\Livewire\Admin\AutoRepairManagement\Suppliers\Edit;
Route::prefix('auto-repair-management/suppliers')->group(function () {
    Route::get('/', Suppliers::class)->name('admin.auto-repair-management.suppliers.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.suppliers.create');
    Route::get('/{' . 'supplier' . '}/edit', Edit::class)->name('admin.auto-repair-management.suppliers.edit');
});