<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\PatientAddresses\PatientAddresses;
use App\Livewire\Admin\ClinicManagement\PatientAddresses\Create;
use App\Livewire\Admin\ClinicManagement\PatientAddresses\Edit;
Route::prefix('clinic-management/patient-addresses')->group(function () {
    Route::get('/', PatientAddresses::class)->name('admin.clinic-management.patient-addresses.index');
    Route::get('create', Create::class)->name('admin.clinic-management.patient-addresses.create');
    Route::get('/{' . 'patientAddress' . '}/edit', Edit::class)->name('admin.clinic-management.patient-addresses.edit');
});