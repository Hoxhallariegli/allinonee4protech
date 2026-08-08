<?php

namespace App\Livewire\Admin\HotelManagement\RoomTypes;

use App\Models\HotelManagement\RoomType;
use App\Domain\HotelManagement\RoomType\DTOs\RoomTypeDTO;
use App\Domain\HotelManagement\RoomType\Actions\CreateRoomTypeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add RoomType')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $base_price = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_room_types');
        return view('livewire.admin.hotel-management.room-types.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateRoomTypeAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/room-types', 'uploads'); }
 $dto = RoomTypeDTO::fromArray([
            'name' => $this->name,
            'base_price' => $this->base_price,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('hotel-management/room-types.created')); return to_route('admin.hotel-management.room-types.index'); }
    protected function rules(): array { return RoomType::rules(); }
}