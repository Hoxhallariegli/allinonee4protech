<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Reports\Reports;
use App\Livewire\Admin\AutoRepairManagement\Reports\Create;
use App\Livewire\Admin\AutoRepairManagement\Reports\Edit;
Route::prefix('auto-repair-management/reports')->group(function () {
    Route::get('/', Reports::class)->name('admin.auto-repair-management.reports.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.reports.create');
    Route::get('/{' . 'report' . '}/edit', Edit::class)->name('admin.auto-repair-management.reports.edit');
});