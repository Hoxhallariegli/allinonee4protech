<?php

namespace App\Livewire\Admin\HotelManagement\RoomTypes;

use App\Models\HotelManagement\RoomType;
use App\Domain\HotelManagement\RoomType\DTOs\RoomTypeDTO;
use App\Domain\HotelManagement\RoomType\Actions\UpdateRoomTypeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit RoomType')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public RoomType $item;
    public $name = '';
    public $base_price = '';
    public $photo = '';
   
    public function mount(RoomType $roomType) { $this->item = $roomType; $this->fill($roomType->toArray());  }
    public function render() {
        abort_if_cannot('edit_room_types');
        return view('livewire.admin.hotel-management.room-types.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateRoomTypeAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/room-types', 'uploads'); }
 $dto = RoomTypeDTO::fromArray([
            'name' => $this->name,
            'base_price' => $this->base_price,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('hotel-management/room-types.updated')); return to_route('admin.hotel-management.room-types.index'); }
    protected function rules(): array { return RoomType::rules($this->item->id); }
}