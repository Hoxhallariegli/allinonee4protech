<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Inventories\Inventories;
use App\Livewire\Admin\AutoRepairManagement\Inventories\Create;
use App\Livewire\Admin\AutoRepairManagement\Inventories\Edit;
Route::prefix('auto-repair-management/inventories')->group(function () {
    Route::get('/', Inventories::class)->name('admin.auto-repair-management.inventories.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.inventories.create');
    Route::get('/{' . 'inventory' . '}/edit', Edit::class)->name('admin.auto-repair-management.inventories.edit');
});