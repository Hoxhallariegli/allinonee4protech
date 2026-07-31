<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Students\Students;
use App\Livewire\Admin\SchoolManagement\Students\Create;
use App\Livewire\Admin\SchoolManagement\Students\Edit;
Route::prefix('school-management/students')->group(function () {
    Route::get('/', Students::class)->name('admin.school-management.students.index');
    Route::get('create', Create::class)->name('admin.school-management.students.create');
    Route::get('/{' . 'student' . '}/edit', Edit::class)->name('admin.school-management.students.edit');
});