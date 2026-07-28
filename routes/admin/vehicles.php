<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Vehicles\Vehicles;
use App\Livewire\Admin\Vehicles\Create;
use App\Livewire\Admin\Vehicles\Edit;
Route::prefix('vehicles')->group(function () {
    Route::get('/', Vehicles::class)->name('admin.vehicles.index');
    Route::get('create', Create::class)->name('admin.vehicles.create');
    Route::get('/{' . 'vehicle' . '}/edit', Edit::class)->name('admin.vehicles.edit');
});