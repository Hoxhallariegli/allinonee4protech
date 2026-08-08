<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PharmacyManagement\Prescriptions\Prescriptions;
use App\Livewire\Admin\PharmacyManagement\Prescriptions\Create;
use App\Livewire\Admin\PharmacyManagement\Prescriptions\Edit;
Route::prefix('pharmacy-management/prescriptions')->group(function () {
    Route::get('/', Prescriptions::class)->name('admin.pharmacy-management.prescriptions.index');
    Route::get('create', Create::class)->name('admin.pharmacy-management.prescriptions.create');
    Route::get('/{' . 'prescription' . '}/edit', Edit::class)->name('admin.pharmacy-management.prescriptions.edit');
});