<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\Payments\Payments;
use App\Livewire\Admin\RealEstateCRM\Payments\Create;
use App\Livewire\Admin\RealEstateCRM\Payments\Edit;
Route::prefix('real-estate-c-r-m/payments')->group(function () {
    Route::get('/', Payments::class)->name('admin.real-estate-c-r-m.payments.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.payments.create');
    Route::get('/{' . 'payment' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.payments.edit');
});