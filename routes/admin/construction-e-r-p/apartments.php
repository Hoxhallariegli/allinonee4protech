<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Apartments\Apartments;
use App\Livewire\Admin\ConstructionERP\Apartments\Create;
use App\Livewire\Admin\ConstructionERP\Apartments\Edit;
Route::prefix('construction-e-r-p/apartments')->group(function () {
    Route::get('/', Apartments::class)->name('admin.construction-e-r-p.apartments.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.apartments.create');
    Route::get('/{' . 'apartment' . '}/edit', Edit::class)->name('admin.construction-e-r-p.apartments.edit');
});