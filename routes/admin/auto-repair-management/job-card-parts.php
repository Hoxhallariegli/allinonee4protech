<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\JobCardParts\JobCardParts;
use App\Livewire\Admin\AutoRepairManagement\JobCardParts\Create;
use App\Livewire\Admin\AutoRepairManagement\JobCardParts\Edit;
Route::prefix('auto-repair-management/job-card-parts')->group(function () {
    Route::get('/', JobCardParts::class)->name('admin.auto-repair-management.job-card-parts.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.job-card-parts.create');
    Route::get('/{' . 'jobCardPart' . '}/edit', Edit::class)->name('admin.auto-repair-management.job-card-parts.edit');
});