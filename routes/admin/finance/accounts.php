<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Finance\Accounts\Accounts;
use App\Livewire\Admin\Finance\Accounts\Create;
use App\Livewire\Admin\Finance\Accounts\Edit;
Route::prefix('finance/accounts')->group(function () {
    Route::get('/', Accounts::class)->name('admin.finance.accounts.index');
    Route::get('create', Create::class)->name('admin.finance.accounts.create');
    Route::get('/{' . 'account' . '}/edit', Edit::class)->name('admin.finance.accounts.edit');
});