<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AgricultureManagement\Crops\Crops;
use App\Livewire\Admin\AgricultureManagement\Crops\Create;
use App\Livewire\Admin\AgricultureManagement\Crops\Edit;
Route::prefix('agriculture-management/crops')->group(function () {
    Route::get('/', Crops::class)->name('admin.agriculture-management.crops.index');
    Route::get('create', Create::class)->name('admin.agriculture-management.crops.create');
    Route::get('/{' . 'crop' . '}/edit', Edit::class)->name('admin.agriculture-management.crops.edit');
});