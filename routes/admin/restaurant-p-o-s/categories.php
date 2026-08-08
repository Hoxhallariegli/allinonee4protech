<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\Categories\Categories;
use App\Livewire\Admin\RestaurantPOS\Categories\Create;
use App\Livewire\Admin\RestaurantPOS\Categories\Edit;
Route::prefix('restaurant-p-o-s/categories')->group(function () {
    Route::get('/', Categories::class)->name('admin.restaurant-p-o-s.categories.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.categories.create');
    Route::get('/{' . 'category' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.categories.edit');
});