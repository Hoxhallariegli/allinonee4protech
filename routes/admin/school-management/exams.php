<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Exams\Exams;
use App\Livewire\Admin\SchoolManagement\Exams\Create;
use App\Livewire\Admin\SchoolManagement\Exams\Edit;
Route::prefix('school-management/exams')->group(function () {
    Route::get('/', Exams::class)->name('admin.school-management.exams.index');
    Route::get('create', Create::class)->name('admin.school-management.exams.create');
    Route::get('/{' . 'exam' . '}/edit', Edit::class)->name('admin.school-management.exams.edit');
});