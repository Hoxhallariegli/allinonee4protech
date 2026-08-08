<?php

namespace App\Livewire\Admin\EventManagement\Bookings;

use App\Models\EventManagement\Booking;
use App\Domain\EventManagement\Booking\DTOs\BookingDTO;
use App\Domain\EventManagement\Booking\Actions\CreateBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Booking')]
class Create extends Component
{
        use WithPagination;
     public $event_id = '';
    public $attendee_id = '';
    public $status = '';
 
    #[On('event-created')] 
    public function refreshEvents($id) { $this->event_id = $id; $this->updatedEventId($id); }

    #[On('attendee-created')] 
    public function refreshAttendees($id) { $this->attendee_id = $id; $this->updatedAttendeeId($id); }
 
    public function updatedEventId($value)
    {
        if (!$value) return;
        $related = \App\Models\EventManagement\Event::find($value);
        if (!$related) return;
    }

    public function updatedAttendeeId($value)
    {
        if (!$value) return;
        $related = \App\Models\EventManagement\Attendee::find($value);
        if (!$related) return;
    }
 
    protected function geteventsList() {
        return \App\Models\EventManagement\Event::pluck('title', 'id')->toArray();
    }

    protected function getattendeesList() {
        return \App\Models\EventManagement\Attendee::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_bookings');
        return view('livewire.admin.event-management.bookings.create', [
            'events' => $this->geteventsList(),
            'attendees' => $this->getattendeesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateBookingAction $action) { $this->validate();  $dto = BookingDTO::fromArray([
            'event_id' => $this->event_id,
            'attendee_id' => $this->attendee_id,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('event-management/bookings.created')); return to_route('admin.event-management.bookings.index'); }
    protected function rules(): array { return Booking::rules(); }
}