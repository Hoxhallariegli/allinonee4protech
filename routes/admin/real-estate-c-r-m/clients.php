<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\Clients\Clients;
use App\Livewire\Admin\RealEstateCRM\Clients\Create;
use App\Livewire\Admin\RealEstateCRM\Clients\Edit;
Route::prefix('real-estate-c-r-m/clients')->group(function () {
    Route::get('/', Clients::class)->name('admin.real-estate-c-r-m.clients.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.clients.create');
    Route::get('/{' . 'client' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.clients.edit');
});