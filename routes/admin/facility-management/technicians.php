<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FacilityManagement\Technicians\Technicians;
use App\Livewire\Admin\FacilityManagement\Technicians\Create;
use App\Livewire\Admin\FacilityManagement\Technicians\Edit;
Route::prefix('facility-management/technicians')->group(function () {
    Route::get('/', Technicians::class)->name('admin.facility-management.technicians.index');
    Route::get('create', Create::class)->name('admin.facility-management.technicians.create');
    Route::get('/{' . 'technician' . '}/edit', Edit::class)->name('admin.facility-management.technicians.edit');
});