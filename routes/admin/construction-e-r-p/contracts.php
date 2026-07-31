<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Contracts\Contracts;
use App\Livewire\Admin\ConstructionERP\Contracts\Create;
use App\Livewire\Admin\ConstructionERP\Contracts\Edit;
Route::prefix('construction-e-r-p/contracts')->group(function () {
    Route::get('/', Contracts::class)->name('admin.construction-e-r-p.contracts.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.contracts.create');
    Route::get('/{' . 'contract' . '}/edit', Edit::class)->name('admin.construction-e-r-p.contracts.edit');
});