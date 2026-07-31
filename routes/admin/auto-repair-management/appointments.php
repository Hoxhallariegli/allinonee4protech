<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Appointments\Appointments;
use App\Livewire\Admin\AutoRepairManagement\Appointments\Create;
use App\Livewire\Admin\AutoRepairManagement\Appointments\Edit;
Route::prefix('auto-repair-management/appointments')->group(function () {
    Route::get('/', Appointments::class)->name('admin.auto-repair-management.appointments.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.appointments.create');
    Route::get('/{' . 'appointment' . '}/edit', Edit::class)->name('admin.auto-repair-management.appointments.edit');
});