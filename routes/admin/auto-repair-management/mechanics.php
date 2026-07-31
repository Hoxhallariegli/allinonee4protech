<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Mechanics\Mechanics;
use App\Livewire\Admin\AutoRepairManagement\Mechanics\Create;
use App\Livewire\Admin\AutoRepairManagement\Mechanics\Edit;
Route::prefix('auto-repair-management/mechanics')->group(function () {
    Route::get('/', Mechanics::class)->name('admin.auto-repair-management.mechanics.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.mechanics.create');
    Route::get('/{' . 'mechanic' . '}/edit', Edit::class)->name('admin.auto-repair-management.mechanics.edit');
});