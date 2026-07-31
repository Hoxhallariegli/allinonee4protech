<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\VehicleDocuments\VehicleDocuments;
use App\Livewire\Admin\AutoRepairManagement\VehicleDocuments\Create;
use App\Livewire\Admin\AutoRepairManagement\VehicleDocuments\Edit;
Route::prefix('auto-repair-management/vehicle-documents')->group(function () {
    Route::get('/', VehicleDocuments::class)->name('admin.auto-repair-management.vehicle-documents.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.vehicle-documents.create');
    Route::get('/{' . 'vehicleDocument' . '}/edit', Edit::class)->name('admin.auto-repair-management.vehicle-documents.edit');
});