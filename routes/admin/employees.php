<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Employees\Employees;
use App\Livewire\Admin\Employees\Create;
use App\Livewire\Admin\Employees\Edit;
Route::prefix('employees')->group(function () {
    Route::get('/', Employees::class)->name('admin.employees.index');
    Route::get('create', Create::class)->name('admin.employees.create');
    Route::get('/{' . 'employee' . '}/edit', Edit::class)->name('admin.employees.edit');
});