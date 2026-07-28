<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\JobCardParts\JobCardParts;
use App\Livewire\Admin\JobCardParts\Create;
use App\Livewire\Admin\JobCardParts\Edit;
Route::prefix('job-card-parts')->group(function () {
    Route::get('/', JobCardParts::class)->name('admin.job-card-parts.index');
    Route::get('create', Create::class)->name('admin.job-card-parts.create');
    Route::get('/{' . 'jobCardPart' . '}/edit', Edit::class)->name('admin.job-card-parts.edit');
});