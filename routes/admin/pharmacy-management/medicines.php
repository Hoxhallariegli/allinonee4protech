<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PharmacyManagement\Medicines\Medicines;
use App\Livewire\Admin\PharmacyManagement\Medicines\Create;
use App\Livewire\Admin\PharmacyManagement\Medicines\Edit;
Route::prefix('pharmacy-management/medicines')->group(function () {
    Route::get('/', Medicines::class)->name('admin.pharmacy-management.medicines.index');
    Route::get('create', Create::class)->name('admin.pharmacy-management.medicines.create');
    Route::get('/{' . 'medicine' . '}/edit', Edit::class)->name('admin.pharmacy-management.medicines.edit');
});