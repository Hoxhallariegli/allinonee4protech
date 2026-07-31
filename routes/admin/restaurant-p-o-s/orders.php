<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\Orders\Orders;
use App\Livewire\Admin\RestaurantPOS\Orders\Create;
use App\Livewire\Admin\RestaurantPOS\Orders\Edit;
Route::prefix('restaurant-p-o-s/orders')->group(function () {
    Route::get('/', Orders::class)->name('admin.restaurant-p-o-s.orders.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.orders.create');
    Route::get('/{' . 'order' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.orders.edit');
});