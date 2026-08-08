<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Finance\Expenses\Expenses;
use App\Livewire\Admin\Finance\Expenses\Create;
use App\Livewire\Admin\Finance\Expenses\Edit;
Route::prefix('finance/expenses')->group(function () {
    Route::get('/', Expenses::class)->name('admin.finance.expenses.index');
    Route::get('create', Create::class)->name('admin.finance.expenses.create');
    Route::get('/{' . 'expense' . '}/edit', Edit::class)->name('admin.finance.expenses.edit');
});