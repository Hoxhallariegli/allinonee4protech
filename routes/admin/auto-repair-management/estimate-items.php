<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\EstimateItems\EstimateItems;
use App\Livewire\Admin\AutoRepairManagement\EstimateItems\Create;
use App\Livewire\Admin\AutoRepairManagement\EstimateItems\Edit;
Route::prefix('auto-repair-management/estimate-items')->group(function () {
    Route::get('/', EstimateItems::class)->name('admin.auto-repair-management.estimate-items.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.estimate-items.create');
    Route::get('/{' . 'estimateItem' . '}/edit', Edit::class)->name('admin.auto-repair-management.estimate-items.edit');
});