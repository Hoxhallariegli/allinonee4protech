<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\InsuranceClaims\InsuranceClaims;
use App\Livewire\Admin\AutoRepairManagement\InsuranceClaims\Create;
use App\Livewire\Admin\AutoRepairManagement\InsuranceClaims\Edit;
Route::prefix('auto-repair-management/insurance-claims')->group(function () {
    Route::get('/', InsuranceClaims::class)->name('admin.auto-repair-management.insurance-claims.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.insurance-claims.create');
    Route::get('/{' . 'insuranceClaim' . '}/edit', Edit::class)->name('admin.auto-repair-management.insurance-claims.edit');
});