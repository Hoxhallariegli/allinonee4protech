<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Grades\Grades;
use App\Livewire\Admin\SchoolManagement\Grades\Create;
use App\Livewire\Admin\SchoolManagement\Grades\Edit;
Route::prefix('school-management/grades')->group(function () {
    Route::get('/', Grades::class)->name('admin.school-management.grades.index');
    Route::get('create', Create::class)->name('admin.school-management.grades.create');
    Route::get('/{' . 'grade' . '}/edit', Edit::class)->name('admin.school-management.grades.edit');
});