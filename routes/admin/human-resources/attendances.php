<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HumanResources\Attendances\Attendances;
use App\Livewire\Admin\HumanResources\Attendances\Create;
use App\Livewire\Admin\HumanResources\Attendances\Edit;
Route::prefix('human-resources/attendances')->group(function () {
    Route::get('/', Attendances::class)->name('admin.human-resources.attendances.index');
    Route::get('create', Create::class)->name('admin.human-resources.attendances.create');
    Route::get('/{' . 'attendance' . '}/edit', Edit::class)->name('admin.human-resources.attendances.edit');
});