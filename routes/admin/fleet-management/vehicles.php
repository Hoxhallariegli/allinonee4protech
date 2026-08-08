<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FleetManagement\Vehicles\Vehicles;
use App\Livewire\Admin\FleetManagement\Vehicles\Create;
use App\Livewire\Admin\FleetManagement\Vehicles\Edit;
Route::prefix('fleet-management/vehicles')->group(function () {
    Route::get('/', Vehicles::class)->name('admin.fleet-management.vehicles.index');
    Route::get('create', Create::class)->name('admin.fleet-management.vehicles.create');
    Route::get('/{' . 'vehicle' . '}/edit', Edit::class)->name('admin.fleet-management.vehicles.edit');
});