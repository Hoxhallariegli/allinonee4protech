<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HotelManagement\HotelRooms\HotelRooms;
use App\Livewire\Admin\HotelManagement\HotelRooms\Create;
use App\Livewire\Admin\HotelManagement\HotelRooms\Edit;
Route::prefix('hotel-management/hotel-rooms')->group(function () {
    Route::get('/', HotelRooms::class)->name('admin.hotel-management.hotel-rooms.index');
    Route::get('create', Create::class)->name('admin.hotel-management.hotel-rooms.create');
    Route::get('/{' . 'hotelRoom' . '}/edit', Edit::class)->name('admin.hotel-management.hotel-rooms.edit');
});