<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TravelAgency\TourBookings\TourBookings;
use App\Livewire\Admin\TravelAgency\TourBookings\Create;
use App\Livewire\Admin\TravelAgency\TourBookings\Edit;
Route::prefix('travel-agency/tour-bookings')->group(function () {
    Route::get('/', TourBookings::class)->name('admin.travel-agency.tour-bookings.index');
    Route::get('create', Create::class)->name('admin.travel-agency.tour-bookings.create');
    Route::get('/{' . 'tourBooking' . '}/edit', Edit::class)->name('admin.travel-agency.tour-bookings.edit');
});