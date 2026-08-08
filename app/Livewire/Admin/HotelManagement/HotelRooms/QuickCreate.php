<?php

namespace App\Livewire\Admin\HotelManagement\HotelRooms;

use App\Models\HotelManagement\HotelRoom;
use App\Domain\HotelManagement\HotelRoom\DTOs\HotelRoomDTO;
use App\Domain\HotelManagement\HotelRoom\Actions\CreateHotelRoomAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $room_number = '';
    public $room_type_id = '';
    public $status = '';
    public $photo = '';
 
    #[On('room-type-created')] 
    public function refreshRoomTypes($id) { $this->room_type_id = $id; $this->updatedRoomTypeId($id); }
 
    public function updatedRoomTypeId($value)
    {
        if (!$value) return;
        $related = \App\Models\HotelManagement\RoomType::find($value);
        if (!$related) return;
    }
 
    protected function getroomTypesList() {
        return \App\Models\HotelManagement\RoomType::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.hotel-management.hotel-rooms.quick-create', [
            'roomTypes' => $this->getroomTypesList(),
        ]); }

    public function store(CreateHotelRoomAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/hotel-rooms', 'uploads'); }
        $dto = HotelRoomDTO::fromArray([
            'room_number' => $this->room_number,
            'room_type_id' => $this->room_type_id,
            'status' => $this->status,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('hotel-room-created', id: $item->id);
        $this->js("Livewire.dispatch('hotel-room-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('hotel-management/hotel-rooms.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['room_number', 'room_type_id', 'status', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return HotelRoom::rules(); }
}