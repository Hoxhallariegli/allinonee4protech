<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\InvoiceItems\InvoiceItems;
use App\Livewire\Admin\AutoRepairManagement\InvoiceItems\Create;
use App\Livewire\Admin\AutoRepairManagement\InvoiceItems\Edit;
Route::prefix('auto-repair-management/invoice-items')->group(function () {
    Route::get('/', InvoiceItems::class)->name('admin.auto-repair-management.invoice-items.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.invoice-items.create');
    Route::get('/{' . 'invoiceItem' . '}/edit', Edit::class)->name('admin.auto-repair-management.invoice-items.edit');
});