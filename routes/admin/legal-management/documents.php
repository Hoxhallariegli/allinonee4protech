<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\LegalManagement\Documents\Documents;
use App\Livewire\Admin\LegalManagement\Documents\Create;
use App\Livewire\Admin\LegalManagement\Documents\Edit;
Route::prefix('legal-management/documents')->group(function () {
    Route::get('/', Documents::class)->name('admin.legal-management.documents.index');
    Route::get('create', Create::class)->name('admin.legal-management.documents.create');
    Route::get('/{' . 'document' . '}/edit', Edit::class)->name('admin.legal-management.documents.edit');
});