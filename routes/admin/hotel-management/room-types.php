<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HotelManagement\RoomTypes\RoomTypes;
use App\Livewire\Admin\HotelManagement\RoomTypes\Create;
use App\Livewire\Admin\HotelManagement\RoomTypes\Edit;
Route::prefix('hotel-management/room-types')->group(function () {
    Route::get('/', RoomTypes::class)->name('admin.hotel-management.room-types.index');
    Route::get('create', Create::class)->name('admin.hotel-management.room-types.create');
    Route::get('/{' . 'roomType' . '}/edit', Edit::class)->name('admin.hotel-management.room-types.edit');
});