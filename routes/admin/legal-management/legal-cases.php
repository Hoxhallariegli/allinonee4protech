<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\LegalManagement\LegalCases\LegalCases;
use App\Livewire\Admin\LegalManagement\LegalCases\Create;
use App\Livewire\Admin\LegalManagement\LegalCases\Edit;
Route::prefix('legal-management/legal-cases')->group(function () {
    Route::get('/', LegalCases::class)->name('admin.legal-management.legal-cases.index');
    Route::get('create', Create::class)->name('admin.legal-management.legal-cases.create');
    Route::get('/{' . 'legalCase' . '}/edit', Edit::class)->name('admin.legal-management.legal-cases.edit');
});