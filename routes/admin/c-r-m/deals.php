<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\Deals\Deals;
use App\Livewire\Admin\CRM\Deals\Create;
use App\Livewire\Admin\CRM\Deals\Edit;
Route::prefix('c-r-m/deals')->group(function () {
    Route::get('/', Deals::class)->name('admin.c-r-m.deals.index');
    Route::get('create', Create::class)->name('admin.c-r-m.deals.create');
    Route::get('/{' . 'deal' . '}/edit', Edit::class)->name('admin.c-r-m.deals.edit');
});