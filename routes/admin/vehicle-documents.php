<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\VehicleDocuments\VehicleDocuments;
use App\Livewire\Admin\VehicleDocuments\Create;
use App\Livewire\Admin\VehicleDocuments\Edit;
Route::prefix('vehicle-documents')->group(function () {
    Route::get('/', VehicleDocuments::class)->name('admin.vehicle-documents.index');
    Route::get('create', Create::class)->name('admin.vehicle-documents.create');
    Route::get('/{' . 'vehicleDocument' . '}/edit', Edit::class)->name('admin.vehicle-documents.edit');
});