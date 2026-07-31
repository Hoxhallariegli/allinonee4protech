<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Materials\Materials;
use App\Livewire\Admin\ConstructionERP\Materials\Create;
use App\Livewire\Admin\ConstructionERP\Materials\Edit;
Route::prefix('construction-e-r-p/materials')->group(function () {
    Route::get('/', Materials::class)->name('admin.construction-e-r-p.materials.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.materials.create');
    Route::get('/{' . 'material' . '}/edit', Edit::class)->name('admin.construction-e-r-p.materials.edit');
});