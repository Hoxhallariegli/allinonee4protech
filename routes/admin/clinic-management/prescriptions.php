<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\Prescriptions\Prescriptions;
use App\Livewire\Admin\ClinicManagement\Prescriptions\Create;
use App\Livewire\Admin\ClinicManagement\Prescriptions\Edit;
Route::prefix('clinic-management/prescriptions')->group(function () {
    Route::get('/', Prescriptions::class)->name('admin.clinic-management.prescriptions.index');
    Route::get('create', Create::class)->name('admin.clinic-management.prescriptions.create');
    Route::get('/{' . 'prescription' . '}/edit', Edit::class)->name('admin.clinic-management.prescriptions.edit');
});