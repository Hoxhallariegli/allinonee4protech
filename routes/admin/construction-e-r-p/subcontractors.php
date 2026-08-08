<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Subcontractors\Subcontractors;
use App\Livewire\Admin\ConstructionERP\Subcontractors\Create;
use App\Livewire\Admin\ConstructionERP\Subcontractors\Edit;
Route::prefix('construction-e-r-p/subcontractors')->group(function () {
    Route::get('/', Subcontractors::class)->name('admin.construction-e-r-p.subcontractors.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.subcontractors.create');
    Route::get('/{' . 'subcontractor' . '}/edit', Edit::class)->name('admin.construction-e-r-p.subcontractors.edit');
});