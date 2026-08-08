<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FleetManagement\Drivers\Drivers;
use App\Livewire\Admin\FleetManagement\Drivers\Create;
use App\Livewire\Admin\FleetManagement\Drivers\Edit;
Route::prefix('fleet-management/drivers')->group(function () {
    Route::get('/', Drivers::class)->name('admin.fleet-management.drivers.index');
    Route::get('create', Create::class)->name('admin.fleet-management.drivers.create');
    Route::get('/{' . 'driver' . '}/edit', Edit::class)->name('admin.fleet-management.drivers.edit');
});