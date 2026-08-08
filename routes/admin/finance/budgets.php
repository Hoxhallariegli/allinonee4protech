<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Finance\Budgets\Budgets;
use App\Livewire\Admin\Finance\Budgets\Create;
use App\Livewire\Admin\Finance\Budgets\Edit;
Route::prefix('finance/budgets')->group(function () {
    Route::get('/', Budgets::class)->name('admin.finance.budgets.index');
    Route::get('create', Create::class)->name('admin.finance.budgets.create');
    Route::get('/{' . 'budget' . '}/edit', Edit::class)->name('admin.finance.budgets.edit');
});