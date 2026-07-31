<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ClinicManagement\Visits\Visits;
use App\Livewire\Admin\ClinicManagement\Visits\Create;
use App\Livewire\Admin\ClinicManagement\Visits\Edit;
Route::prefix('clinic-management/visits')->group(function () {
    Route::get('/', Visits::class)->name('admin.clinic-management.visits.index');
    Route::get('create', Create::class)->name('admin.clinic-management.visits.create');
    Route::get('/{' . 'visit' . '}/edit', Edit::class)->name('admin.clinic-management.visits.edit');
});