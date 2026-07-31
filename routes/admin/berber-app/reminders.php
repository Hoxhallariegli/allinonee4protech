<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\BerberApp\Reminders\Reminders;
use App\Livewire\Admin\BerberApp\Reminders\Create;
use App\Livewire\Admin\BerberApp\Reminders\Edit;
Route::prefix('berber-app/reminders')->group(function () {
    Route::get('/', Reminders::class)->name('admin.berber-app.reminders.index');
    Route::get('create', Create::class)->name('admin.berber-app.reminders.create');
    Route::get('/{' . 'reminder' . '}/edit', Edit::class)->name('admin.berber-app.reminders.edit');
});