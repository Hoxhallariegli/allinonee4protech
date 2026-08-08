<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Finance\Categories\Categories;
use App\Livewire\Admin\Finance\Categories\Create;
use App\Livewire\Admin\Finance\Categories\Edit;
Route::prefix('finance/categories')->group(function () {
    Route::get('/', Categories::class)->name('admin.finance.categories.index');
    Route::get('create', Create::class)->name('admin.finance.categories.create');
    Route::get('/{' . 'category' . '}/edit', Edit::class)->name('admin.finance.categories.edit');
});