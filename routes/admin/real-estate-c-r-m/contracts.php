<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\Contracts\Contracts;
use App\Livewire\Admin\RealEstateCRM\Contracts\Create;
use App\Livewire\Admin\RealEstateCRM\Contracts\Edit;
Route::prefix('real-estate-c-r-m/contracts')->group(function () {
    Route::get('/', Contracts::class)->name('admin.real-estate-c-r-m.contracts.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.contracts.create');
    Route::get('/{' . 'contract' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.contracts.edit');
});