<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Buildings\Buildings;
use App\Livewire\Admin\ConstructionERP\Buildings\Create;
use App\Livewire\Admin\ConstructionERP\Buildings\Edit;
Route::prefix('construction-e-r-p/buildings')->group(function () {
    Route::get('/', Buildings::class)->name('admin.construction-e-r-p.buildings.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.buildings.create');
    Route::get('/{' . 'building' . '}/edit', Edit::class)->name('admin.construction-e-r-p.buildings.edit');
});