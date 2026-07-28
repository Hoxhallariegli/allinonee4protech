<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Appointments\Appointments;
use App\Livewire\Admin\Appointments\Create;
use App\Livewire\Admin\Appointments\Edit;
Route::prefix('appointments')->group(function () {
    Route::get('/', Appointments::class)->name('admin.appointments.index');
    Route::get('create', Create::class)->name('admin.appointments.create');
    Route::get('/{' . 'appointment' . '}/edit', Edit::class)->name('admin.appointments.edit');
});