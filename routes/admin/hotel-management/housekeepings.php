<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HotelManagement\Housekeepings\Housekeepings;
use App\Livewire\Admin\HotelManagement\Housekeepings\Create;
use App\Livewire\Admin\HotelManagement\Housekeepings\Edit;
Route::prefix('hotel-management/housekeepings')->group(function () {
    Route::get('/', Housekeepings::class)->name('admin.hotel-management.housekeepings.index');
    Route::get('create', Create::class)->name('admin.hotel-management.housekeepings.create');
    Route::get('/{' . 'housekeeping' . '}/edit', Edit::class)->name('admin.hotel-management.housekeepings.edit');
});