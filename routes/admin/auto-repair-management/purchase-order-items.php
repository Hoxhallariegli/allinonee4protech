<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\PurchaseOrderItems\PurchaseOrderItems;
use App\Livewire\Admin\AutoRepairManagement\PurchaseOrderItems\Create;
use App\Livewire\Admin\AutoRepairManagement\PurchaseOrderItems\Edit;
Route::prefix('auto-repair-management/purchase-order-items')->group(function () {
    Route::get('/', PurchaseOrderItems::class)->name('admin.auto-repair-management.purchase-order-items.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.purchase-order-items.create');
    Route::get('/{' . 'purchaseOrderItem' . '}/edit', Edit::class)->name('admin.auto-repair-management.purchase-order-items.edit');
});