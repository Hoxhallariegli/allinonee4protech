<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Bookings\Bookings;
use App\Livewire\Admin\BerberApp\Bookings\Create;
use App\Livewire\Admin\BerberApp\Bookings\Edit;
Route::prefix('berber-app/bookings')->group(function () {
    Route::get('/', Bookings::class)->name('admin.berber-app.bookings.index');
    Route::get('create', Create::class)->name('admin.berber-app.bookings.create');
    Route::get('/{' . 'booking' . '}/edit', Edit::class)->name('admin.berber-app.bookings.edit');
});