<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Sales\Sales;
use App\Livewire\Admin\Sales\Create;
use App\Livewire\Admin\Sales\Edit;

Route::prefix('sales')->group(function () {
    Route::get('/', Sales::class)->name('admin.sales.index')->middleware('can:view_sales');
    Route::get('create', Create::class)->name('admin.sales.create')->middleware('can:add_sales');
    Route::get('{sale}/edit', Edit::class)->name('admin.sales.edit')->middleware('can:edit_sales');
});
