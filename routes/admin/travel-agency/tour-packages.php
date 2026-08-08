<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TravelAgency\TourPackages\TourPackages;
use App\Livewire\Admin\TravelAgency\TourPackages\Create;
use App\Livewire\Admin\TravelAgency\TourPackages\Edit;
Route::prefix('travel-agency/tour-packages')->group(function () {
    Route::get('/', TourPackages::class)->name('admin.travel-agency.tour-packages.index');
    Route::get('create', Create::class)->name('admin.travel-agency.tour-packages.create');
    Route::get('/{' . 'tourPackage' . '}/edit', Edit::class)->name('admin.travel-agency.tour-packages.edit');
});