<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\StockAdjustments\StockAdjustments;
use App\Livewire\Admin\WarehouseManagement\StockAdjustments\Create;
use App\Livewire\Admin\WarehouseManagement\StockAdjustments\Edit;
Route::prefix('warehouse-management/stock-adjustments')->group(function () {
    Route::get('/', StockAdjustments::class)->name('admin.warehouse-management.stock-adjustments.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.stock-adjustments.create');
    Route::get('/{' . 'stockAdjustment' . '}/edit', Edit::class)->name('admin.warehouse-management.stock-adjustments.edit');
});