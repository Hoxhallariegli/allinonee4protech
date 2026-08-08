<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EventManagement\Events\Events;
use App\Livewire\Admin\EventManagement\Events\Create;
use App\Livewire\Admin\EventManagement\Events\Edit;
Route::prefix('event-management/events')->group(function () {
    Route::get('/', Events::class)->name('admin.event-management.events.index');
    Route::get('create', Create::class)->name('admin.event-management.events.create');
    Route::get('/{' . 'event' . '}/edit', Edit::class)->name('admin.event-management.events.edit');
});