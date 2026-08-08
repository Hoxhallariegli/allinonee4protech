<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\ClientAddresses\ClientAddresses;
use App\Livewire\Admin\RealEstateCRM\ClientAddresses\Create;
use App\Livewire\Admin\RealEstateCRM\ClientAddresses\Edit;
Route::prefix('real-estate-c-r-m/client-addresses')->group(function () {
    Route::get('/', ClientAddresses::class)->name('admin.real-estate-c-r-m.client-addresses.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.client-addresses.create');
    Route::get('/{' . 'clientAddress' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.client-addresses.edit');
});