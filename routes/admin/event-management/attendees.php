<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EventManagement\Attendees\Attendees;
use App\Livewire\Admin\EventManagement\Attendees\Create;
use App\Livewire\Admin\EventManagement\Attendees\Edit;
Route::prefix('event-management/attendees')->group(function () {
    Route::get('/', Attendees::class)->name('admin.event-management.attendees.index');
    Route::get('create', Create::class)->name('admin.event-management.attendees.create');
    Route::get('/{' . 'attendee' . '}/edit', Edit::class)->name('admin.event-management.attendees.edit');
});