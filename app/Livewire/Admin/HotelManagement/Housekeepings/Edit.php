<?php

namespace App\Livewire\Admin\HotelManagement\Housekeepings;

use App\Models\HotelManagement\Housekeeping;
use App\Domain\HotelManagement\Housekeeping\DTOs\HousekeepingDTO;
use App\Domain\HotelManagement\Housekeeping\Actions\UpdateHousekeepingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Housekeeping')]
class Edit extends Component
{
        use WithPagination;
 public Housekeeping $item;
    public $room_id = '';
    public $task = '';
    public $is_completed = '';
 
    #[On('hotel-room-created')] 
    public function refreshRooms($id) { $this->room_id = $id; $this->updatedRoomId($id); }
 
    public function updatedRoomId($value)
    {
        if (!$value) return;
        $related = \App\Models\HotelManagement\HotelRoom::find($value);
        if (!$related) return;
    }
 
    protected function getroomsList() {
        return \App\Models\HotelManagement\HotelRoom::pluck('room_number', 'id')->toArray();
    }

    public function mount(Housekeeping $housekeeping) { $this->item = $housekeeping; $this->fill($housekeeping->toArray());  }
    public function render() {
        abort_if_cannot('edit_housekeepings');
        return view('livewire.admin.hotel-management.housekeepings.edit', [
            'rooms' => $this->getroomsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateHousekeepingAction $action) { $this->validate();  $dto = HousekeepingDTO::fromArray([
            'room_id' => $this->room_id,
            'task' => $this->task,
            'is_completed' => $this->is_completed,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('hotel-management/housekeepings.updated')); return to_route('admin.hotel-management.housekeepings.index'); }
    protected function rules(): array { return Housekeeping::rules($this->item->id); }
}