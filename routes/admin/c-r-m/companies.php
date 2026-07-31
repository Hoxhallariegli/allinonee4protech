<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\Companies\Companies;
use App\Livewire\Admin\CRM\Companies\Create;
use App\Livewire\Admin\CRM\Companies\Edit;
Route::prefix('c-r-m/companies')->group(function () {
    Route::get('/', Companies::class)->name('admin.c-r-m.companies.index');
    Route::get('create', Create::class)->name('admin.c-r-m.companies.create');
    Route::get('/{' . 'company' . '}/edit', Edit::class)->name('admin.c-r-m.companies.edit');
});