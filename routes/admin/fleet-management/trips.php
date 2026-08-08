<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FleetManagement\Trips\Trips;
use App\Livewire\Admin\FleetManagement\Trips\Create;
use App\Livewire\Admin\FleetManagement\Trips\Edit;
Route::prefix('fleet-management/trips')->group(function () {
    Route::get('/', Trips::class)->name('admin.fleet-management.trips.index');
    Route::get('create', Create::class)->name('admin.fleet-management.trips.create');
    Route::get('/{' . 'trip' . '}/edit', Edit::class)->name('admin.fleet-management.trips.edit');
});