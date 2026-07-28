<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\InvoiceItems\InvoiceItems;
use App\Livewire\Admin\InvoiceItems\Create;
use App\Livewire\Admin\InvoiceItems\Edit;
Route::prefix('invoice-items')->group(function () {
    Route::get('/', InvoiceItems::class)->name('admin.invoice-items.index');
    Route::get('create', Create::class)->name('admin.invoice-items.create');
    Route::get('/{' . 'invoiceItem' . '}/edit', Edit::class)->name('admin.invoice-items.edit');
});