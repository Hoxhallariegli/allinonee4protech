<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Teachers\Teachers;
use App\Livewire\Admin\SchoolManagement\Teachers\Create;
use App\Livewire\Admin\SchoolManagement\Teachers\Edit;
Route::prefix('school-management/teachers')->group(function () {
    Route::get('/', Teachers::class)->name('admin.school-management.teachers.index');
    Route::get('create', Create::class)->name('admin.school-management.teachers.create');
    Route::get('/{' . 'teacher' . '}/edit', Edit::class)->name('admin.school-management.teachers.edit');
});