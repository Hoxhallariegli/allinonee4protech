<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ECommerce\Orders\Orders;
use App\Livewire\Admin\ECommerce\Orders\Create;
use App\Livewire\Admin\ECommerce\Orders\Edit;
Route::prefix('e--commerce/orders')->group(function () {
    Route::get('/', Orders::class)->name('admin.e--commerce.orders.index');
    Route::get('create', Create::class)->name('admin.e--commerce.orders.create');
    Route::get('/{' . 'order' . '}/edit', Edit::class)->name('admin.e--commerce.orders.edit');
});