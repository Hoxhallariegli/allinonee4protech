<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Categories\Categories;
use App\Livewire\Admin\Categories\Create;
use App\Livewire\Admin\Categories\Edit;

Route::prefix('categories')->group(function () {
    Route::get('/', Categories::class)->name('admin.categories.index')->middleware('can:view_categories');
    Route::get('create', Create::class)->name('admin.categories.create')->middleware('can:add_categories');
    Route::get('{category}/edit', Edit::class)->name('admin.categories.edit')->middleware('can:edit_categories');
});
