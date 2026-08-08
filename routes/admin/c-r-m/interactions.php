<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\Interactions\Interactions;
use App\Livewire\Admin\CRM\Interactions\Create;
use App\Livewire\Admin\CRM\Interactions\Edit;
Route::prefix('c-r-m/interactions')->group(function () {
    Route::get('/', Interactions::class)->name('admin.c-r-m.interactions.index');
    Route::get('create', Create::class)->name('admin.c-r-m.interactions.create');
    Route::get('/{' . 'interaction' . '}/edit', Edit::class)->name('admin.c-r-m.interactions.edit');
});