<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PurchaseOrderItems\PurchaseOrderItems;
use App\Livewire\Admin\PurchaseOrderItems\Create;
use App\Livewire\Admin\PurchaseOrderItems\Edit;
Route::prefix('purchase-order-items')->group(function () {
    Route::get('/', PurchaseOrderItems::class)->name('admin.purchase-order-items.index');
    Route::get('create', Create::class)->name('admin.purchase-order-items.create');
    Route::get('/{' . 'purchaseOrderItem' . '}/edit', Edit::class)->name('admin.purchase-order-items.edit');
});