<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Estimates\Estimates;
use App\Livewire\Admin\Estimates\Create;
use App\Livewire\Admin\Estimates\Edit;
Route::prefix('estimates')->group(function () {
    Route::get('/', Estimates::class)->name('admin.estimates.index');
    Route::get('create', Create::class)->name('admin.estimates.create');
    Route::get('/{' . 'estimate' . '}/edit', Edit::class)->name('admin.estimates.edit');
});