<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Attendances\Attendances;
use App\Livewire\Admin\SchoolManagement\Attendances\Create;
use App\Livewire\Admin\SchoolManagement\Attendances\Edit;
Route::prefix('school-management/attendances')->group(function () {
    Route::get('/', Attendances::class)->name('admin.school-management.attendances.index');
    Route::get('create', Create::class)->name('admin.school-management.attendances.create');
    Route::get('/{' . 'attendance' . '}/edit', Edit::class)->name('admin.school-management.attendances.edit');
});