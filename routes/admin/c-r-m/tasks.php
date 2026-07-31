<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\Tasks\Tasks;
use App\Livewire\Admin\CRM\Tasks\Create;
use App\Livewire\Admin\CRM\Tasks\Edit;
Route::prefix('c-r-m/tasks')->group(function () {
    Route::get('/', Tasks::class)->name('admin.c-r-m.tasks.index');
    Route::get('create', Create::class)->name('admin.c-r-m.tasks.create');
    Route::get('/{' . 'task' . '}/edit', Edit::class)->name('admin.c-r-m.tasks.edit');
});