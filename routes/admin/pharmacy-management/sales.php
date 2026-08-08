<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PharmacyManagement\Sales\Sales;
use App\Livewire\Admin\PharmacyManagement\Sales\Create;
use App\Livewire\Admin\PharmacyManagement\Sales\Edit;
Route::prefix('pharmacy-management/sales')->group(function () {
    Route::get('/', Sales::class)->name('admin.pharmacy-management.sales.index');
    Route::get('create', Create::class)->name('admin.pharmacy-management.sales.create');
    Route::get('/{' . 'sale' . '}/edit', Edit::class)->name('admin.pharmacy-management.sales.edit');
});