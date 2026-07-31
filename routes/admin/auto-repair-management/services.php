<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Services\Services;
use App\Livewire\Admin\AutoRepairManagement\Services\Create;
use App\Livewire\Admin\AutoRepairManagement\Services\Edit;
Route::prefix('auto-repair-management/services')->group(function () {
    Route::get('/', Services::class)->name('admin.auto-repair-management.services.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.services.create');
    Route::get('/{' . 'service' . '}/edit', Edit::class)->name('admin.auto-repair-management.services.edit');
});