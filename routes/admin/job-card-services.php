<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\JobCardServices\JobCardServices;
use App\Livewire\Admin\JobCardServices\Create;
use App\Livewire\Admin\JobCardServices\Edit;
Route::prefix('job-card-services')->group(function () {
    Route::get('/', JobCardServices::class)->name('admin.job-card-services.index');
    Route::get('create', Create::class)->name('admin.job-card-services.create');
    Route::get('/{' . 'jobCardService' . '}/edit', Edit::class)->name('admin.job-card-services.edit');
});