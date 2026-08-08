<?php

namespace App\Livewire\Admin\HotelManagement\Reservations;

use App\Models\HotelManagement\Reservation;
use App\Domain\HotelManagement\Reservation\DTOs\ReservationDTO;
use App\Domain\HotelManagement\Reservation\Actions\UpdateReservationAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Reservation')]
class Edit extends Component
{
        use WithPagination;
 public Reservation $item;
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

    public function mount(Reservation $reservation) { $this->item = $reservation; $this->fill($reservation->toArray()); $this->check_in = $reservation->check_in?->format('Y-m-d'); $this->check_out = $reservation->check_out?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_reservations');
        return view('livewire.admin.hotel-management.reservations.edit', [
            'guests' => $this->getguestsList(),
            'rooms' => $this->getroomsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateReservationAction $action) { $this->validate();  $dto = ReservationDTO::fromArray([
            'guest_id' => $this->guest_id,
            'room_id' => $this->room_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'total_price' => $this->total_price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('hotel-management/reservations.updated')); return to_route('admin.hotel-management.reservations.index'); }
    protected function rules(): array { return Reservation::rules($this->item->id); }
}