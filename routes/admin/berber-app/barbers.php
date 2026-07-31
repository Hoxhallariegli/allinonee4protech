<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Barbers\Barbers;
use App\Livewire\Admin\BerberApp\Barbers\Create;
use App\Livewire\Admin\BerberApp\Barbers\Edit;
use App\Livewire\Admin\BerberApp\Barbers\Configuration;

Route::prefix('berber-app/barbers')->group(function () {
    Route::get('/', Barbers::class)->name('admin.berber-app.barbers.index');
    Route::get('create', Create::class)->name('admin.berber-app.barbers.create');
    Route::get('/{barber}/edit', Edit::class)->name('admin.berber-app.barbers.edit');
    Route::get('/{barber}/configuration', Configuration::class)->name('admin.berber-app.barbers.configuration');
});
