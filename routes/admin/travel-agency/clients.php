<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TravelAgency\Clients\Clients;
use App\Livewire\Admin\TravelAgency\Clients\Create;
use App\Livewire\Admin\TravelAgency\Clients\Edit;
Route::prefix('travel-agency/clients')->group(function () {
    Route::get('/', Clients::class)->name('admin.travel-agency.clients.index');
    Route::get('create', Create::class)->name('admin.travel-agency.clients.create');
    Route::get('/{' . 'client' . '}/edit', Edit::class)->name('admin.travel-agency.clients.edit');
});