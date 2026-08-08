<?php

namespace App\Livewire\Admin\EventManagement\Bookings;

use App\Models\EventManagement\Booking;
use App\Domain\EventManagement\Booking\Queries\BookingListQuery;
use App\Domain\EventManagement\Booking\Actions\DeleteBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Bookings')]
class Bookings extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $event_id = '';
    #[Url(history: true)] public $attendee_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'event_id', 'attendee_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_bookings');
        $query = (new BookingListQuery())->handle(['search' => $this->search,             'event_id' => $this->event_id,
            'attendee_id' => $this->attendee_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.event-management.bookings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Booking::sortable(),
            'events' => \App\Models\EventManagement\Event::pluck('title', 'id')->toArray(),
            'attendees' => \App\Models\EventManagement\Attendee::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Booking::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteBooking($id, DeleteBookingAction $action) 
    {
        abort_if_cannot('delete_bookings');
        $item = Booking::find($id);
        if (!$item) { $this->dispatch('toast', message: __('event-management/bookings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('event-management/bookings.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('event-management/bookings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('event-management/bookings.delete_error'), type: 'error'); }
    }
}