<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\JobCards\JobCards;
use App\Livewire\Admin\JobCards\Create;
use App\Livewire\Admin\JobCards\Edit;
Route::prefix('job-cards')->group(function () {
    Route::get('/', JobCards::class)->name('admin.job-cards.index');
    Route::get('create', Create::class)->name('admin.job-cards.create');
    Route::get('/{' . 'jobCard' . '}/edit', Edit::class)->name('admin.job-cards.edit');
});