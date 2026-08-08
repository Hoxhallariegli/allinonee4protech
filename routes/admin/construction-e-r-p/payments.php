<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ConstructionERP\Payments\Payments;
use App\Livewire\Admin\ConstructionERP\Payments\Create;
use App\Livewire\Admin\ConstructionERP\Payments\Edit;
Route::prefix('construction-e-r-p/payments')->group(function () {
    Route::get('/', Payments::class)->name('admin.construction-e-r-p.payments.index');
    Route::get('create', Create::class)->name('admin.construction-e-r-p.payments.create');
    Route::get('/{' . 'payment' . '}/edit', Edit::class)->name('admin.construction-e-r-p.payments.edit');
});