<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\HumanResources\Payrolls\Payrolls;
use App\Livewire\Admin\HumanResources\Payrolls\Create;
use App\Livewire\Admin\HumanResources\Payrolls\Edit;
Route::prefix('human-resources/payrolls')->group(function () {
    Route::get('/', Payrolls::class)->name('admin.human-resources.payrolls.index');
    Route::get('create', Create::class)->name('admin.human-resources.payrolls.create');
    Route::get('/{' . 'payroll' . '}/edit', Edit::class)->name('admin.human-resources.payrolls.edit');
});