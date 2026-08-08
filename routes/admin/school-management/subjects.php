<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Subjects\Subjects;
use App\Livewire\Admin\SchoolManagement\Subjects\Create;
use App\Livewire\Admin\SchoolManagement\Subjects\Edit;
Route::prefix('school-management/subjects')->group(function () {
    Route::get('/', Subjects::class)->name('admin.school-management.subjects.index');
    Route::get('create', Create::class)->name('admin.school-management.subjects.create');
    Route::get('/{' . 'subject' . '}/edit', Edit::class)->name('admin.school-management.subjects.edit');
});