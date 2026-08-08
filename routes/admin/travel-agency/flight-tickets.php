<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TravelAgency\FlightTickets\FlightTickets;
use App\Livewire\Admin\TravelAgency\FlightTickets\Create;
use App\Livewire\Admin\TravelAgency\FlightTickets\Edit;
Route::prefix('travel-agency/flight-tickets')->group(function () {
    Route::get('/', FlightTickets::class)->name('admin.travel-agency.flight-tickets.index');
    Route::get('create', Create::class)->name('admin.travel-agency.flight-tickets.create');
    Route::get('/{' . 'flightTicket' . '}/edit', Edit::class)->name('admin.travel-agency.flight-tickets.edit');
});