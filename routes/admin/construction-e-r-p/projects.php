<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Projects\Projects;
use App\Livewire\Admin\ConstructionERP\Projects\Create;
use App\Livewire\Admin\ConstructionERP\Projects\Edit;
Route::prefix('construction-e-r-p/projects')->group(function () {
    Route::get('/', Projects::class)->name('admin.construction-e-r-p.projects.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.projects.create');
    Route::get('/{' . 'project' . '}/edit', Edit::class)->name('admin.construction-e-r-p.projects.edit');
});