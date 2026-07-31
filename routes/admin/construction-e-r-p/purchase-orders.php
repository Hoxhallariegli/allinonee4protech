<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\PurchaseOrders\PurchaseOrders;
use App\Livewire\Admin\ConstructionERP\PurchaseOrders\Create;
use App\Livewire\Admin\ConstructionERP\PurchaseOrders\Edit;
Route::prefix('construction-e-r-p/purchase-orders')->group(function () {
    Route::get('/', PurchaseOrders::class)->name('admin.construction-e-r-p.purchase-orders.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.purchase-orders.create');
    Route::get('/{' . 'purchaseOrder' . '}/edit', Edit::class)->name('admin.construction-e-r-p.purchase-orders.edit');
});