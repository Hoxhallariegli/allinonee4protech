<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\OrderItems\OrderItems;
use App\Livewire\Admin\RestaurantPOS\OrderItems\Create;
use App\Livewire\Admin\RestaurantPOS\OrderItems\Edit;
Route::prefix('restaurant-p-o-s/order-items')->group(function () {
    Route::get('/', OrderItems::class)->name('admin.restaurant-p-o-s.order-items.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.order-items.create');
    Route::get('/{' . 'orderItem' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.order-items.edit');
});