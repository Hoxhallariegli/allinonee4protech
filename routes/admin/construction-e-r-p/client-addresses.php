<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\ClientAddresses\ClientAddresses;
use App\Livewire\Admin\ConstructionERP\ClientAddresses\Create;
use App\Livewire\Admin\ConstructionERP\ClientAddresses\Edit;
Route::prefix('construction-e-r-p/client-addresses')->group(function () {
    Route::get('/', ClientAddresses::class)->name('admin.construction-e-r-p.client-addresses.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.client-addresses.create');
    Route::get('/{' . 'clientAddress' . '}/edit', Edit::class)->name('admin.construction-e-r-p.client-addresses.edit');
});