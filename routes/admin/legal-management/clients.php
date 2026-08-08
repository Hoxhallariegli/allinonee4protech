<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\LegalManagement\Clients\Clients;
use App\Livewire\Admin\LegalManagement\Clients\Create;
use App\Livewire\Admin\LegalManagement\Clients\Edit;
Route::prefix('legal-management/clients')->group(function () {
    Route::get('/', Clients::class)->name('admin.legal-management.clients.index');
    Route::get('create', Create::class)->name('admin.legal-management.clients.create');
    Route::get('/{' . 'client' . '}/edit', Edit::class)->name('admin.legal-management.clients.edit');
});