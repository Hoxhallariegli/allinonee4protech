<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EventManagement\Bookings\Bookings;
use App\Livewire\Admin\EventManagement\Bookings\Create;
use App\Livewire\Admin\EventManagement\Bookings\Edit;
Route::prefix('event-management/bookings')->group(function () {
    Route::get('/', Bookings::class)->name('admin.event-management.bookings.index');
    Route::get('create', Create::class)->name('admin.event-management.bookings.create');
    Route::get('/{' . 'booking' . '}/edit', Edit::class)->name('admin.event-management.bookings.edit');
});