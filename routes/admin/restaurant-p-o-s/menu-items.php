<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\MenuItems\MenuItems;
use App\Livewire\Admin\RestaurantPOS\MenuItems\Create;
use App\Livewire\Admin\RestaurantPOS\MenuItems\Edit;
Route::prefix('restaurant-p-o-s/menu-items')->group(function () {
    Route::get('/', MenuItems::class)->name('admin.restaurant-p-o-s.menu-items.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.menu-items.create');
    Route::get('/{' . 'menuItem' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.menu-items.edit');
});