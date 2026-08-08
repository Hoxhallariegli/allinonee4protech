<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PharmacyManagement\PrescriptionItems\PrescriptionItems;
use App\Livewire\Admin\PharmacyManagement\PrescriptionItems\Create;
use App\Livewire\Admin\PharmacyManagement\PrescriptionItems\Edit;
Route::prefix('pharmacy-management/prescription-items')->group(function () {
    Route::get('/', PrescriptionItems::class)->name('admin.pharmacy-management.prescription-items.index');
    Route::get('create', Create::class)->name('admin.pharmacy-management.prescription-items.create');
    Route::get('/{' . 'prescriptionItem' . '}/edit', Edit::class)->name('admin.pharmacy-management.prescription-items.edit');
});