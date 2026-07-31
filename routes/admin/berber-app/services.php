<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Services\Services;
use App\Livewire\Admin\BerberApp\Services\Create;
use App\Livewire\Admin\BerberApp\Services\Edit;
Route::prefix('berber-app/services')->group(function () {
    Route::get('/', Services::class)->name('admin.berber-app.services.index');
    Route::get('create', Create::class)->name('admin.berber-app.services.create');
    Route::get('/{' . 'service' . '}/edit', Edit::class)->name('admin.berber-app.services.edit');
});