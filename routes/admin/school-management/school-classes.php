<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\SchoolClasses\SchoolClasses;
use App\Livewire\Admin\SchoolManagement\SchoolClasses\Create;
use App\Livewire\Admin\SchoolManagement\SchoolClasses\Edit;
Route::prefix('school-management/school-classes')->group(function () {
    Route::get('/', SchoolClasses::class)->name('admin.school-management.school-classes.index');
    Route::get('create', Create::class)->name('admin.school-management.school-classes.create');
    Route::get('/{' . 'schoolClass' . '}/edit', Edit::class)->name('admin.school-management.school-classes.edit');
});