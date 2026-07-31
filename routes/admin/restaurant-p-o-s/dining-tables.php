<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RestaurantPOS\DiningTables\DiningTables;
use App\Livewire\Admin\RestaurantPOS\DiningTables\Create;
use App\Livewire\Admin\RestaurantPOS\DiningTables\Edit;
Route::prefix('restaurant-p-o-s/dining-tables')->group(function () {
    Route::get('/', DiningTables::class)->name('admin.restaurant-p-o-s.dining-tables.index');
    Route::get('create', Create::class)->name('admin.restaurant-p-o-s.dining-tables.create');
    Route::get('/{' . 'diningTable' . '}/edit', Edit::class)->name('admin.restaurant-p-o-s.dining-tables.edit');
});