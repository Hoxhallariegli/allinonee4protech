<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\ClinicInvoices\ClinicInvoices;
use App\Livewire\Admin\ClinicManagement\ClinicInvoices\Create;
use App\Livewire\Admin\ClinicManagement\ClinicInvoices\Edit;
Route::prefix('clinic-management/clinic-invoices')->group(function () {
    Route::get('/', ClinicInvoices::class)->name('admin.clinic-management.clinic-invoices.index');
    Route::get('create', Create::class)->name('admin.clinic-management.clinic-invoices.create');
    Route::get('/{' . 'clinicInvoice' . '}/edit', Edit::class)->name('admin.clinic-management.clinic-invoices.edit');
});