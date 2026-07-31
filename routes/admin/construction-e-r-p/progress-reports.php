<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\ProgressReports\ProgressReports;
use App\Livewire\Admin\ConstructionERP\ProgressReports\Create;
use App\Livewire\Admin\ConstructionERP\ProgressReports\Edit;
Route::prefix('construction-e-r-p/progress-reports')->group(function () {
    Route::get('/', ProgressReports::class)->name('admin.construction-e-r-p.progress-reports.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.progress-reports.create');
    Route::get('/{' . 'progressReport' . '}/edit', Edit::class)->name('admin.construction-e-r-p.progress-reports.edit');
});