<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\LegalManagement\Hearings\Hearings;
use App\Livewire\Admin\LegalManagement\Hearings\Create;
use App\Livewire\Admin\LegalManagement\Hearings\Edit;
Route::prefix('legal-management/hearings')->group(function () {
    Route::get('/', Hearings::class)->name('admin.legal-management.hearings.index');
    Route::get('create', Create::class)->name('admin.legal-management.hearings.create');
    Route::get('/{' . 'hearing' . '}/edit', Edit::class)->name('admin.legal-management.hearings.edit');
});