<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\Patients\Patients;
use App\Livewire\Admin\ClinicManagement\Patients\Create;
use App\Livewire\Admin\ClinicManagement\Patients\Edit;
Route::prefix('clinic-management/patients')->group(function () {
    Route::get('/', Patients::class)->name('admin.clinic-management.patients.index');
    Route::get('create', Create::class)->name('admin.clinic-management.patients.create');
    Route::get('/{' . 'patient' . '}/edit', Edit::class)->name('admin.clinic-management.patients.edit');
});