<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ECommerce\OrderItems\OrderItems;
use App\Livewire\Admin\ECommerce\OrderItems\Create;
use App\Livewire\Admin\ECommerce\OrderItems\Edit;
Route::prefix('e--commerce/order-items')->group(function () {
    Route::get('/', OrderItems::class)->name('admin.e--commerce.order-items.index');
    Route::get('create', Create::class)->name('admin.e--commerce.order-items.create');
    Route::get('/{' . 'orderItem' . '}/edit', Edit::class)->name('admin.e--commerce.order-items.edit');
});