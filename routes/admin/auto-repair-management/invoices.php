<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Invoices\Invoices;
use App\Livewire\Admin\AutoRepairManagement\Invoices\Create;
use App\Livewire\Admin\AutoRepairManagement\Invoices\Edit;
Route::prefix('auto-repair-management/invoices')->group(function () {
    Route::get('/', Invoices::class)->name('admin.auto-repair-management.invoices.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.invoices.create');
    Route::get('/{' . 'invoice' . '}/edit', Edit::class)->name('admin.auto-repair-management.invoices.edit');
});