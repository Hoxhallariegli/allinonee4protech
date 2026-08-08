<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AgricultureManagement\InventorySupplies\InventorySupplies;
use App\Livewire\Admin\AgricultureManagement\InventorySupplies\Create;
use App\Livewire\Admin\AgricultureManagement\InventorySupplies\Edit;
Route::prefix('agriculture-management/inventory-supplies')->group(function () {
    Route::get('/', InventorySupplies::class)->name('admin.agriculture-management.inventory-supplies.index');
    Route::get('create', Create::class)->name('admin.agriculture-management.inventory-supplies.create');
    Route::get('/{' . 'inventorySupply' . '}/edit', Edit::class)->name('admin.agriculture-management.inventory-supplies.edit');
});