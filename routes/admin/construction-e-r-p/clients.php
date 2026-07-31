<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Clients\Clients;
use App\Livewire\Admin\ConstructionERP\Clients\Create;
use App\Livewire\Admin\ConstructionERP\Clients\Edit;
Route::prefix('construction-e-r-p/clients')->group(function () {
    Route::get('/', Clients::class)->name('admin.construction-e-r-p.clients.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.clients.create');
    Route::get('/{' . 'client' . '}/edit', Edit::class)->name('admin.construction-e-r-p.clients.edit');
});