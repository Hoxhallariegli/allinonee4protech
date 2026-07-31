<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\Payments\Payments;
use App\Livewire\Admin\RestaurantPOS\Payments\Create;
use App\Livewire\Admin\RestaurantPOS\Payments\Edit;
Route::prefix('restaurant-p-o-s/payments')->group(function () {
    Route::get('/', Payments::class)->name('admin.restaurant-p-o-s.payments.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.payments.create');
    Route::get('/{' . 'payment' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.payments.edit');
});