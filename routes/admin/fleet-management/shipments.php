<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FleetManagement\Shipments\Shipments;
use App\Livewire\Admin\FleetManagement\Shipments\Create;
use App\Livewire\Admin\FleetManagement\Shipments\Edit;
Route::prefix('fleet-management/shipments')->group(function () {
    Route::get('/', Shipments::class)->name('admin.fleet-management.shipments.index');
    Route::get('create', Create::class)->name('admin.fleet-management.shipments.create');
    Route::get('/{' . 'shipment' . '}/edit', Edit::class)->name('admin.fleet-management.shipments.edit');
});