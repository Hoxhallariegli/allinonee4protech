<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\Ingredients\Ingredients;
use App\Livewire\Admin\RestaurantPOS\Ingredients\Create;
use App\Livewire\Admin\RestaurantPOS\Ingredients\Edit;
Route::prefix('restaurant-p-o-s/ingredients')->group(function () {
    Route::get('/', Ingredients::class)->name('admin.restaurant-p-o-s.ingredients.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.ingredients.create');
    Route::get('/{' . 'ingredient' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.ingredients.edit');
});