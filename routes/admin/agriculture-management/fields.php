<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AgricultureManagement\Fields\Fields;
use App\Livewire\Admin\AgricultureManagement\Fields\Create;
use App\Livewire\Admin\AgricultureManagement\Fields\Edit;
Route::prefix('agriculture-management/fields')->group(function () {
    Route::get('/', Fields::class)->name('admin.agriculture-management.fields.index');
    Route::get('create', Create::class)->name('admin.agriculture-management.fields.create');
    Route::get('/{' . 'field' . '}/edit', Edit::class)->name('admin.agriculture-management.fields.edit');
});