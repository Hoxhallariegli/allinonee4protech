<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\MedicalVitals\MedicalVitals;
use App\Livewire\Admin\ClinicManagement\MedicalVitals\Create;
use App\Livewire\Admin\ClinicManagement\MedicalVitals\Edit;
Route::prefix('clinic-management/medical-vitals')->group(function () {
    Route::get('/', MedicalVitals::class)->name('admin.clinic-management.medical-vitals.index');
    Route::get('create', Create::class)->name('admin.clinic-management.medical-vitals.create');
    Route::get('/{' . 'medicalVital' . '}/edit', Edit::class)->name('admin.clinic-management.medical-vitals.edit');
});