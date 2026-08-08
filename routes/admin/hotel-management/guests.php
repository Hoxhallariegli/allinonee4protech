<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HotelManagement\Guests\Guests;
use App\Livewire\Admin\HotelManagement\Guests\Create;
use App\Livewire\Admin\HotelManagement\Guests\Edit;
Route::prefix('hotel-management/guests')->group(function () {
    Route::get('/', Guests::class)->name('admin.hotel-management.guests.index');
    Route::get('create', Create::class)->name('admin.hotel-management.guests.create');
    Route::get('/{' . 'guest' . '}/edit', Edit::class)->name('admin.hotel-management.guests.edit');
});