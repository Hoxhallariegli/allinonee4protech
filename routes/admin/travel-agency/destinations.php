<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TravelAgency\Destinations\Destinations;
use App\Livewire\Admin\TravelAgency\Destinations\Create;
use App\Livewire\Admin\TravelAgency\Destinations\Edit;
Route::prefix('travel-agency/destinations')->group(function () {
    Route::get('/', Destinations::class)->name('admin.travel-agency.destinations.index');
    Route::get('create', Create::class)->name('admin.travel-agency.destinations.create');
    Route::get('/{' . 'destination' . '}/edit', Edit::class)->name('admin.travel-agency.destinations.edit');
});