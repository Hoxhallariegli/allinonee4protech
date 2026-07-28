<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Invoices\Invoices;
use App\Livewire\Admin\Invoices\Create;
use App\Livewire\Admin\Invoices\Edit;
Route::prefix('invoices')->group(function () {
    Route::get('/', Invoices::class)->name('admin.invoices.index');
    Route::get('create', Create::class)->name('admin.invoices.create');
    Route::get('/{' . 'invoice' . '}/edit', Edit::class)->name('admin.invoices.edit');
});