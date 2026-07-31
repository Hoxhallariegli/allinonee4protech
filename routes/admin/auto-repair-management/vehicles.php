<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Vehicles\Vehicles;
use App\Livewire\Admin\AutoRepairManagement\Vehicles\Create;
use App\Livewire\Admin\AutoRepairManagement\Vehicles\Edit;
Route::prefix('auto-repair-management/vehicles')->group(function () {
    Route::get('/', Vehicles::class)->name('admin.auto-repair-management.vehicles.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.vehicles.create');
    Route::get('/{' . 'vehicle' . '}/edit', Edit::class)->name('admin.auto-repair-management.vehicles.edit');
});