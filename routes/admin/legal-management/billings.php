<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\LegalManagement\Billings\Billings;
use App\Livewire\Admin\LegalManagement\Billings\Create;
use App\Livewire\Admin\LegalManagement\Billings\Edit;
Route::prefix('legal-management/billings')->group(function () {
    Route::get('/', Billings::class)->name('admin.legal-management.billings.index');
    Route::get('create', Create::class)->name('admin.legal-management.billings.create');
    Route::get('/{' . 'billing' . '}/edit', Edit::class)->name('admin.legal-management.billings.edit');
});