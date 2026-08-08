<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Timetables\Timetables;
use App\Livewire\Admin\SchoolManagement\Timetables\Create;
use App\Livewire\Admin\SchoolManagement\Timetables\Edit;
Route::prefix('school-management/timetables')->group(function () {
    Route::get('/', Timetables::class)->name('admin.school-management.timetables.index');
    Route::get('create', Create::class)->name('admin.school-management.timetables.create');
    Route::get('/{' . 'timetable' . '}/edit', Edit::class)->name('admin.school-management.timetables.edit');
});