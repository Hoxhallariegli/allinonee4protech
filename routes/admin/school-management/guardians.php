<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\SchoolManagement\Guardians\Guardians;
use App\Livewire\Admin\SchoolManagement\Guardians\Create;
use App\Livewire\Admin\SchoolManagement\Guardians\Edit;
Route::prefix('school-management/guardians')->group(function () {
    Route::get('/', Guardians::class)->name('admin.school-management.guardians.index');
    Route::get('create', Create::class)->name('admin.school-management.guardians.create');
    Route::get('/{' . 'guardian' . '}/edit', Edit::class)->name('admin.school-management.guardians.edit');
});