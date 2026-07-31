<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\Employees\Employees;
use App\Livewire\Admin\AutoRepairManagement\Employees\Create;
use App\Livewire\Admin\AutoRepairManagement\Employees\Edit;
Route::prefix('auto-repair-management/employees')->group(function () {
    Route::get('/', Employees::class)->name('admin.auto-repair-management.employees.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.employees.create');
    Route::get('/{' . 'employee' . '}/edit', Edit::class)->name('admin.auto-repair-management.employees.edit');
});