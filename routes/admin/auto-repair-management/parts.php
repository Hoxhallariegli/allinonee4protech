<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Parts\Parts;
use App\Livewire\Admin\AutoRepairManagement\Parts\Create;
use App\Livewire\Admin\AutoRepairManagement\Parts\Edit;
Route::prefix('auto-repair-management/parts')->group(function () {
    Route::get('/', Parts::class)->name('admin.auto-repair-management.parts.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.parts.create');
    Route::get('/{' . 'part' . '}/edit', Edit::class)->name('admin.auto-repair-management.parts.edit');
});