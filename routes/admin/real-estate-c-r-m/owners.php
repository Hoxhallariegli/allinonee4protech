<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RealEstateCRM\Owners\Owners;
use App\Livewire\Admin\RealEstateCRM\Owners\Create;
use App\Livewire\Admin\RealEstateCRM\Owners\Edit;
Route::prefix('real-estate-c-r-m/owners')->group(function () {
    Route::get('/', Owners::class)->name('admin.real-estate-c-r-m.owners.index');
    Route::get('create', Create::class)->name('admin.real-estate-c-r-m.owners.create');
    Route::get('/{' . 'owner' . '}/edit', Edit::class)->name('admin.real-estate-c-r-m.owners.edit');
});