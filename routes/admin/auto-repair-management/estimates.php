<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Estimates\Estimates;
use App\Livewire\Admin\AutoRepairManagement\Estimates\Create;
use App\Livewire\Admin\AutoRepairManagement\Estimates\Edit;
Route::prefix('auto-repair-management/estimates')->group(function () {
    Route::get('/', Estimates::class)->name('admin.auto-repair-management.estimates.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.estimates.create');
    Route::get('/{' . 'estimate' . '}/edit', Edit::class)->name('admin.auto-repair-management.estimates.edit');
});