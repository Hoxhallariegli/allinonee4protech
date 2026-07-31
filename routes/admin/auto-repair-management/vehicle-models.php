<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\VehicleModels\VehicleModels;
use App\Livewire\Admin\AutoRepairManagement\VehicleModels\Create;
use App\Livewire\Admin\AutoRepairManagement\VehicleModels\Edit;
Route::prefix('auto-repair-management/vehicle-models')->group(function () {
    Route::get('/', VehicleModels::class)->name('admin.auto-repair-management.vehicle-models.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.vehicle-models.create');
    Route::get('/{' . 'vehicleModel' . '}/edit', Edit::class)->name('admin.auto-repair-management.vehicle-models.edit');
});