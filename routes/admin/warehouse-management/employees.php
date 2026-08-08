<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\WarehouseManagement\Employees\Employees;
use App\Livewire\Admin\WarehouseManagement\Employees\Create;
use App\Livewire\Admin\WarehouseManagement\Employees\Edit;
Route::prefix('warehouse-management/employees')->group(function () {
    Route::get('/', Employees::class)->name('admin.warehouse-management.employees.index');
    Route::get('create', Create::class)->name('admin.warehouse-management.employees.create');
    Route::get('/{' . 'employee' . '}/edit', Edit::class)->name('admin.warehouse-management.employees.edit');
});