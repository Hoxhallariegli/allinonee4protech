<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EventManagement\Organizers\Organizers;
use App\Livewire\Admin\EventManagement\Organizers\Create;
use App\Livewire\Admin\EventManagement\Organizers\Edit;
Route::prefix('event-management/organizers')->group(function () {
    Route::get('/', Organizers::class)->name('admin.event-management.organizers.index');
    Route::get('create', Create::class)->name('admin.event-management.organizers.create');
    Route::get('/{' . 'organizer' . '}/edit', Edit::class)->name('admin.event-management.organizers.edit');
});