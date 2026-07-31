<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\VehicleBrands\VehicleBrands;
use App\Livewire\Admin\AutoRepairManagement\VehicleBrands\Create;
use App\Livewire\Admin\AutoRepairManagement\VehicleBrands\Edit;
Route::prefix('auto-repair-management/vehicle-brands')->group(function () {
    Route::get('/', VehicleBrands::class)->name('admin.auto-repair-management.vehicle-brands.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.vehicle-brands.create');
    Route::get('/{' . 'vehicleBrand' . '}/edit', Edit::class)->name('admin.auto-repair-management.vehicle-brands.edit');
});