<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\Properties\Properties;
use App\Livewire\Admin\RealEstateCRM\Properties\Create;
use App\Livewire\Admin\RealEstateCRM\Properties\Edit;
Route::prefix('real-estate-c-r-m/properties')->group(function () {
    Route::get('/', Properties::class)->name('admin.real-estate-c-r-m.properties.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.properties.create');
    Route::get('/{' . 'property' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.properties.edit');
});