<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\Doctors\Doctors;
use App\Livewire\Admin\ClinicManagement\Doctors\Create;
use App\Livewire\Admin\ClinicManagement\Doctors\Edit;
Route::prefix('clinic-management/doctors')->group(function () {
    Route::get('/', Doctors::class)->name('admin.clinic-management.doctors.index');
    Route::get('create', Create::class)->name('admin.clinic-management.doctors.create');
    Route::get('/{' . 'doctor' . '}/edit', Edit::class)->name('admin.clinic-management.doctors.edit');
});