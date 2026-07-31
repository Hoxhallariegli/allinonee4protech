<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\PurchaseOrders\PurchaseOrders;
use App\Livewire\Admin\AutoRepairManagement\PurchaseOrders\Create;
use App\Livewire\Admin\AutoRepairManagement\PurchaseOrders\Edit;
Route::prefix('auto-repair-management/purchase-orders')->group(function () {
    Route::get('/', PurchaseOrders::class)->name('admin.auto-repair-management.purchase-orders.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.purchase-orders.create');
    Route::get('/{' . 'purchaseOrder' . '}/edit', Edit::class)->name('admin.auto-repair-management.purchase-orders.edit');
});