<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\PropertyVisits\PropertyVisits;
use App\Livewire\Admin\RealEstateCRM\PropertyVisits\Create;
use App\Livewire\Admin\RealEstateCRM\PropertyVisits\Edit;
Route::prefix('real-estate-c-r-m/property-visits')->group(function () {
    Route::get('/', PropertyVisits::class)->name('admin.real-estate-c-r-m.property-visits.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.property-visits.create');
    Route::get('/{' . 'propertyVisit' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.property-visits.edit');
});