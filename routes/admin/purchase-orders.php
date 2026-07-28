<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PurchaseOrders\PurchaseOrders;
use App\Livewire\Admin\PurchaseOrders\Create;
use App\Livewire\Admin\PurchaseOrders\Edit;
Route::prefix('purchase-orders')->group(function () {
    Route::get('/', PurchaseOrders::class)->name('admin.purchase-orders.index');
    Route::get('create', Create::class)->name('admin.purchase-orders.create');
    Route::get('/{' . 'purchaseOrder' . '}/edit', Edit::class)->name('admin.purchase-orders.edit');
});