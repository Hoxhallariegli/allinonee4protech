<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Assignments\Assignments;
use App\Livewire\Admin\SchoolManagement\Assignments\Create;
use App\Livewire\Admin\SchoolManagement\Assignments\Edit;
Route::prefix('school-management/assignments')->group(function () {
    Route::get('/', Assignments::class)->name('admin.school-management.assignments.index');
    Route::get('create', Create::class)->name('admin.school-management.assignments.create');
    Route::get('/{' . 'assignment' . '}/edit', Edit::class)->name('admin.school-management.assignments.edit');
});