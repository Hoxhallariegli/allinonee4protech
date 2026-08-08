<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\Recipes\Recipes;
use App\Livewire\Admin\RestaurantPOS\Recipes\Create;
use App\Livewire\Admin\RestaurantPOS\Recipes\Edit;
Route::prefix('restaurant-p-o-s/recipes')->group(function () {
    Route::get('/', Recipes::class)->name('admin.restaurant-p-o-s.recipes.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.recipes.create');
    Route::get('/{' . 'recipe' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.recipes.edit');
});