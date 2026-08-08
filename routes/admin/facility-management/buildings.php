<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FacilityManagement\Buildings\Buildings;
use App\Livewire\Admin\FacilityManagement\Buildings\Create;
use App\Livewire\Admin\FacilityManagement\Buildings\Edit;
Route::prefix('facility-management/buildings')->group(function () {
    Route::get('/', Buildings::class)->name('admin.facility-management.buildings.index');
    Route::get('create', Create::class)->name('admin.facility-management.buildings.create');
    Route::get('/{' . 'building' . '}/edit', Edit::class)->name('admin.facility-management.buildings.edit');
});