<?php

namespace App\Livewire\Admin\HotelManagement\Reservations;

use App\Models\HotelManagement\Reservation;
use App\Domain\HotelManagement\Reservation\DTOs\ReservationDTO;
use App\Domain\HotelManagement\Reservation\Actions\CreateReservationAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $guest_id = '';
    public $room_id = '';
    public $check_in = '';
    public $check_out = '';
    public $total_price = '';
 
    #[On('guest-created')] 
    public function refreshGuests($id) { $this->guest_id = $id; $this->updatedGuestId($id); }

    #[On('hotel-room-created')] 
    public function refreshRooms($id) { $this->room_id = $id; $this->updatedRoomId($id); }
 
    public function updatedGuestId($value)
    {
        if (!$value) return;
        $related = \App\Models\HotelManagement\Guest::find($value);
        if (!$related) return;
    }

    public function updatedRoomId($value)
    {
        if (!$value) return;
        $related = \App\Models\HotelManagement\HotelRoom::find($value);
        if (!$related) return;
    }
 
    protected function getguestsList() {
        return \App\Models\HotelManagement\Guest::pluck('name', 'id')->toArray();
    }

    protected function getroomsList() {
        return \App\Models\HotelManagement\HotelRoom::pluck('room_number', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.hotel-management.reservations.quick-create', [
            'guests' => $this->getguestsList(),
            'rooms' => $this->getroomsList(),
        ]); }

    public function store(CreateReservationAction $action)
    {
        $this->validate();
        $dto = ReservationDTO::fromArray([
            'guest_id' => $this->guest_id,
            'room_id' => $this->room_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'total_price' => $this->total_price,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('reservation-created', id: $item->id);
        $this->js("Livewire.dispatch('reservation-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('hotel-management/reservations.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['guest_id', 'room_id', 'check_in', 'check_out', 'total_price']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Reservation::rules(); }
}