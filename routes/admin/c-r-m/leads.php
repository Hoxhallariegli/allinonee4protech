<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\CRM\Leads\Leads;
use App\Livewire\Admin\CRM\Leads\Create;
use App\Livewire\Admin\CRM\Leads\Edit;
Route::prefix('c-r-m/leads')->group(function () {
    Route::get('/', Leads::class)->name('admin.c-r-m.leads.index');
    Route::get('create', Create::class)->name('admin.c-r-m.leads.create');
    Route::get('/{' . 'lead' . '}/edit', Edit::class)->name('admin.c-r-m.leads.edit');
});