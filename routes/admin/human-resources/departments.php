<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HumanResources\Departments\Departments;
use App\Livewire\Admin\HumanResources\Departments\Create;
use App\Livewire\Admin\HumanResources\Departments\Edit;
Route::prefix('human-resources/departments')->group(function () {
    Route::get('/', Departments::class)->name('admin.human-resources.departments.index');
    Route::get('create', Create::class)->name('admin.human-resources.departments.create');
    Route::get('/{' . 'department' . '}/edit', Edit::class)->name('admin.human-resources.departments.edit');
});