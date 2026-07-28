<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Inventories\Inventories;
use App\Livewire\Admin\Inventories\Create;
use App\Livewire\Admin\Inventories\Edit;
Route::prefix('inventories')->group(function () {
    Route::get('/', Inventories::class)->name('admin.inventories.index');
    Route::get('create', Create::class)->name('admin.inventories.create');
    Route::get('/{' . 'inventory' . '}/edit', Edit::class)->name('admin.inventories.edit');
});