<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\EventManagement\TicketTypes\TicketTypes;
use App\Livewire\Admin\EventManagement\TicketTypes\Create;
use App\Livewire\Admin\EventManagement\TicketTypes\Edit;
Route::prefix('event-management/ticket-types')->group(function () {
    Route::get('/', TicketTypes::class)->name('admin.event-management.ticket-types.index');
    Route::get('create', Create::class)->name('admin.event-management.ticket-types.create');
    Route::get('/{' . 'ticketType' . '}/edit', Edit::class)->name('admin.event-management.ticket-types.edit');
});