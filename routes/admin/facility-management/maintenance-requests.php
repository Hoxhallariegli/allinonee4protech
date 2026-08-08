<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FacilityManagement\MaintenanceRequests\MaintenanceRequests;
use App\Livewire\Admin\FacilityManagement\MaintenanceRequests\Create;
use App\Livewire\Admin\FacilityManagement\MaintenanceRequests\Edit;
Route::prefix('facility-management/maintenance-requests')->group(function () {
    Route::get('/', MaintenanceRequests::class)->name('admin.facility-management.maintenance-requests.index');
    Route::get('create', Create::class)->name('admin.facility-management.maintenance-requests.create');
    Route::get('/{' . 'maintenanceRequest' . '}/edit', Edit::class)->name('admin.facility-management.maintenance-requests.edit');
});