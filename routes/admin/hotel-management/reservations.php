<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HotelManagement\Reservations\Reservations;
use App\Livewire\Admin\HotelManagement\Reservations\Create;
use App\Livewire\Admin\HotelManagement\Reservations\Edit;
Route::prefix('hotel-management/reservations')->group(function () {
    Route::get('/', Reservations::class)->name('admin.hotel-management.reservations.index');
    Route::get('create', Create::class)->name('admin.hotel-management.reservations.create');
    Route::get('/{' . 'reservation' . '}/edit', Edit::class)->name('admin.hotel-management.reservations.edit');
});