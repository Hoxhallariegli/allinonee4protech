<?php

namespace App\Livewire\Admin\BerberApp\Reminders;

use App\Models\BerberApp\Reminder;
use App\Domain\BerberApp\Reminder\DTOs\ReminderDTO;
use App\Domain\BerberApp\Reminder\Actions\CreateReminderAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $booking_id = '';
    public $send_at = '';
    public $sent_at = '';
    public $type = '';
    public $status = '';
 
    #[On('booking-created')] 
    public function refreshBookings($id) { $this->booking_id = $id; $this->updatedBookingId($id); }
 
    public function updatedBookingId($value)
    {
        if (!$value) return;
        $related = \App\Models\BerberApp\Booking::find($value);
        if (!$related) return;
    }
 
    protected function getbookingsList() {
        return \App\Models\BerberApp\Booking::pluck('id', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.berber-app.reminders.quick-create', [
            'bookings' => $this->getbookingsList(),
        ]); }

    public function store(CreateReminderAction $action)
    {
        $this->validate();
        $dto = ReminderDTO::fromArray([
            'booking_id' => $this->booking_id,
            'send_at' => $this->send_at,
            'sent_at' => $this->sent_at,
            'type' => $this->type,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('reminder-created', id: $item->id);
        $this->js("Livewire.dispatch('reminder-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('berber-app/reminders.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['booking_id', 'send_at', 'sent_at', 'type', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Reminder::rules(); }
}