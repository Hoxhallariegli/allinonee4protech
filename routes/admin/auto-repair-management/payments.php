<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Payments\Payments;
use App\Livewire\Admin\AutoRepairManagement\Payments\Create;
use App\Livewire\Admin\AutoRepairManagement\Payments\Edit;
Route::prefix('auto-repair-management/payments')->group(function () {
    Route::get('/', Payments::class)->name('admin.auto-repair-management.payments.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.payments.create');
    Route::get('/{' . 'payment' . '}/edit', Edit::class)->name('admin.auto-repair-management.payments.edit');
});