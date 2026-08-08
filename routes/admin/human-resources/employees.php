<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HumanResources\Employees\Employees;
use App\Livewire\Admin\HumanResources\Employees\Create;
use App\Livewire\Admin\HumanResources\Employees\Edit;
Route::prefix('human-resources/employees')->group(function () {
    Route::get('/', Employees::class)->name('admin.human-resources.employees.index');
    Route::get('create', Create::class)->name('admin.human-resources.employees.create');
    Route::get('/{' . 'employee' . '}/edit', Edit::class)->name('admin.human-resources.employees.edit');
});