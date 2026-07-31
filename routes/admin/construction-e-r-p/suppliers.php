<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Suppliers\Suppliers;
use App\Livewire\Admin\ConstructionERP\Suppliers\Create;
use App\Livewire\Admin\ConstructionERP\Suppliers\Edit;
Route::prefix('construction-e-r-p/suppliers')->group(function () {
    Route::get('/', Suppliers::class)->name('admin.construction-e-r-p.suppliers.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.suppliers.create');
    Route::get('/{' . 'supplier' . '}/edit', Edit::class)->name('admin.construction-e-r-p.suppliers.edit');
});