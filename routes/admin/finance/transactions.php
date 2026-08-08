<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Finance\Transactions\Transactions;
use App\Livewire\Admin\Finance\Transactions\Create;
use App\Livewire\Admin\Finance\Transactions\Edit;
Route::prefix('finance/transactions')->group(function () {
    Route::get('/', Transactions::class)->name('admin.finance.transactions.index');
    Route::get('create', Create::class)->name('admin.finance.transactions.create');
    Route::get('/{' . 'transaction' . '}/edit', Edit::class)->name('admin.finance.transactions.edit');
});