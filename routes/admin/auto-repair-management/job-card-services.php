<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AutoRepairManagement\JobCardServices\JobCardServices;
use App\Livewire\Admin\AutoRepairManagement\JobCardServices\Create;
use App\Livewire\Admin\AutoRepairManagement\JobCardServices\Edit;
Route::prefix('auto-repair-management/job-card-services')->group(function () {
    Route::get('/', JobCardServices::class)->name('admin.auto-repair-management.job-card-services.index');
    Route::get('create', Create::class)->name('admin.auto-repair-management.job-card-services.create');
    Route::get('/{' . 'jobCardService' . '}/edit', Edit::class)->name('admin.auto-repair-management.job-card-services.edit');
});