<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\HeavyMachineries\HeavyMachineries;
use App\Livewire\Admin\ConstructionERP\HeavyMachineries\Create;
use App\Livewire\Admin\ConstructionERP\HeavyMachineries\Edit;
Route::prefix('construction-e-r-p/heavy-machineries')->group(function () {
    Route::get('/', HeavyMachineries::class)->name('admin.construction-e-r-p.heavy-machineries.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.heavy-machineries.create');
    Route::get('/{' . 'heavyMachinery' . '}/edit', Edit::class)->name('admin.construction-e-r-p.heavy-machineries.edit');
});