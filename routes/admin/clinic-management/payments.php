<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\Payments\Payments;
use App\Livewire\Admin\ClinicManagement\Payments\Create;
use App\Livewire\Admin\ClinicManagement\Payments\Edit;
Route::prefix('clinic-management/payments')->group(function () {
    Route::get('/', Payments::class)->name('admin.clinic-management.payments.index');
    Route::get('create', Create::class)->name('admin.clinic-management.payments.create');
    Route::get('/{' . 'payment' . '}/edit', Edit::class)->name('admin.clinic-management.payments.edit');
});