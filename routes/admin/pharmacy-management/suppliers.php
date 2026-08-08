<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PharmacyManagement\Suppliers\Suppliers;
use App\Livewire\Admin\PharmacyManagement\Suppliers\Create;
use App\Livewire\Admin\PharmacyManagement\Suppliers\Edit;
Route::prefix('pharmacy-management/suppliers')->group(function () {
    Route::get('/', Suppliers::class)->name('admin.pharmacy-management.suppliers.index');
    Route::get('create', Create::class)->name('admin.pharmacy-management.suppliers.create');
    Route::get('/{' . 'supplier' . '}/edit', Edit::class)->name('admin.pharmacy-management.suppliers.edit');
});