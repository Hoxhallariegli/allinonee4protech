<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Employees\Employees;
use App\Livewire\Admin\ConstructionERP\Employees\Create;
use App\Livewire\Admin\ConstructionERP\Employees\Edit;
Route::prefix('construction-e-r-p/employees')->group(function () {
    Route::get('/', Employees::class)->name('admin.construction-e-r-p.employees.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.employees.create');
    Route::get('/{' . 'employee' . '}/edit', Edit::class)->name('admin.construction-e-r-p.employees.edit');
});