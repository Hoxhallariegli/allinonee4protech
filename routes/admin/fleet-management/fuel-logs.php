<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FleetManagement\FuelLogs\FuelLogs;
use App\Livewire\Admin\FleetManagement\FuelLogs\Create;
use App\Livewire\Admin\FleetManagement\FuelLogs\Edit;
Route::prefix('fleet-management/fuel-logs')->group(function () {
    Route::get('/', FuelLogs::class)->name('admin.fleet-management.fuel-logs.index');
    Route::get('create', Create::class)->name('admin.fleet-management.fuel-logs.create');
    Route::get('/{' . 'fuelLog' . '}/edit', Edit::class)->name('admin.fleet-management.fuel-logs.edit');
});