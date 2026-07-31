<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\JobCards\JobCards;
use App\Livewire\Admin\AutoRepairManagement\JobCards\Create;
use App\Livewire\Admin\AutoRepairManagement\JobCards\Edit;
Route::prefix('auto-repair-management/job-cards')->group(function () {
    Route::get('/', JobCards::class)->name('admin.auto-repair-management.job-cards.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.job-cards.create');
    Route::get('/{' . 'jobCard' . '}/edit', Edit::class)->name('admin.auto-repair-management.job-cards.edit');
});