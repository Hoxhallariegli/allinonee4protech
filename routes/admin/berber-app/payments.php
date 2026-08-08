<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Payments\Payments;
use App\Livewire\Admin\BerberApp\Payments\Create;
use App\Livewire\Admin\BerberApp\Payments\Edit;
Route::prefix('berber-app/payments')->group(function () {
    Route::get('/', Payments::class)->name('admin.berber-app.payments.index');
    Route::get('create', Create::class)->name('admin.berber-app.payments.create');
    Route::get('/{' . 'payment' . '}/edit', Edit::class)->name('admin.berber-app.payments.edit');
});