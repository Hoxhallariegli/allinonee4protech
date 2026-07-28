<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EstimateItems\EstimateItems;
use App\Livewire\Admin\EstimateItems\Create;
use App\Livewire\Admin\EstimateItems\Edit;
Route::prefix('estimate-items')->group(function () {
    Route::get('/', EstimateItems::class)->name('admin.estimate-items.index');
    Route::get('create', Create::class)->name('admin.estimate-items.create');
    Route::get('/{' . 'estimateItem' . '}/edit', Edit::class)->name('admin.estimate-items.edit');
});