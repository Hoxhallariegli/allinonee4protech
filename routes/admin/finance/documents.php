<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Finance\Documents\Documents;
use App\Livewire\Admin\Finance\Documents\Create;
use App\Livewire\Admin\Finance\Documents\Edit;
Route::prefix('finance/documents')->group(function () {
    Route::get('/', Documents::class)->name('admin.finance.documents.index');
    Route::get('create', Create::class)->name('admin.finance.documents.create');
    Route::get('/{' . 'document' . '}/edit', Edit::class)->name('admin.finance.documents.edit');
});