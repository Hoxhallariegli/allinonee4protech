<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\Waiters\Waiters;
use App\Livewire\Admin\RestaurantPOS\Waiters\Create;
use App\Livewire\Admin\RestaurantPOS\Waiters\Edit;
Route::prefix('restaurant-p-o-s/waiters')->group(function () {
    Route::get('/', Waiters::class)->name('admin.restaurant-p-o-s.waiters.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.waiters.create');
    Route::get('/{' . 'waiter' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.waiters.edit');
});