<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\StockTransfers\StockTransfers;
use App\Livewire\Admin\WarehouseManagement\StockTransfers\Create;
use App\Livewire\Admin\WarehouseManagement\StockTransfers\Edit;
Route::prefix('warehouse-management/stock-transfers')->group(function () {
    Route::get('/', StockTransfers::class)->name('admin.warehouse-management.stock-transfers.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.stock-transfers.create');
    Route::get('/{' . 'stockTransfer' . '}/edit', Edit::class)->name('admin.warehouse-management.stock-transfers.edit');
});