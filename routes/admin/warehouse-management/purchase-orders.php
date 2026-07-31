<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\PurchaseOrders\PurchaseOrders;
use App\Livewire\Admin\WarehouseManagement\PurchaseOrders\Create;
use App\Livewire\Admin\WarehouseManagement\PurchaseOrders\Edit;
Route::prefix('warehouse-management/purchase-orders')->group(function () {
    Route::get('/', PurchaseOrders::class)->name('admin.warehouse-management.purchase-orders.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.purchase-orders.create');
    Route::get('/{' . 'purchaseOrder' . '}/edit', Edit::class)->name('admin.warehouse-management.purchase-orders.edit');
});