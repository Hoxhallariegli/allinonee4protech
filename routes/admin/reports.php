<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Reports\Reports;
use App\Livewire\Admin\Reports\Create;
use App\Livewire\Admin\Reports\Edit;
Route::prefix('reports')->group(function () {
    Route::get('/', Reports::class)->name('admin.reports.index');
    Route::get('create', Create::class)->name('admin.reports.create');
    Route::get('/{' . 'report' . '}/edit', Edit::class)->name('admin.reports.edit');
});