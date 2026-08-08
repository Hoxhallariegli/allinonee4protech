<?php

namespace App\Livewire\Admin\HotelManagement\HotelRooms;

use App\Models\HotelManagement\HotelRoom;
use App\Domain\HotelManagement\HotelRoom\DTOs\HotelRoomDTO;
use App\Domain\HotelManagement\HotelRoom\Actions\UpdateHotelRoomAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit HotelRoom')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public HotelRoom $item;
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

    public function mount(HotelRoom $hotelRoom) { $this->item = $hotelRoom; $this->fill($hotelRoom->toArray());  }
    public function render() {
        abort_if_cannot('edit_hotel_rooms');
        return view('livewire.admin.hotel-management.hotel-rooms.edit', [
            'roomTypes' => $this->getroomTypesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateHotelRoomAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/hotel-rooms', 'uploads'); }
 $dto = HotelRoomDTO::fromArray([
            'room_number' => $this->room_number,
            'room_type_id' => $this->room_type_id,
            'status' => $this->status,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('hotel-management/hotel-rooms.updated')); return to_route('admin.hotel-management.hotel-rooms.index'); }
    protected function rules(): array { return HotelRoom::rules($this->item->id); }
}