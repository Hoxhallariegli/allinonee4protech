<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Mechanics\Mechanics;
use App\Livewire\Admin\Mechanics\Create;
use App\Livewire\Admin\Mechanics\Edit;
Route::prefix('mechanics')->group(function () {
    Route::get('/', Mechanics::class)->name('admin.mechanics.index');
    Route::get('create', Create::class)->name('admin.mechanics.create');
    Route::get('/{' . 'mechanic' . '}/edit', Edit::class)->name('admin.mechanics.edit');
});