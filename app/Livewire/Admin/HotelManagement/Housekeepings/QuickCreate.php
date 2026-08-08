<?php

namespace App\Livewire\Admin\HotelManagement\Housekeepings;

use App\Models\HotelManagement\Housekeeping;
use App\Domain\HotelManagement\Housekeeping\DTOs\HousekeepingDTO;
use App\Domain\HotelManagement\Housekeeping\Actions\CreateHousekeepingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.hotel-management.housekeepings.quick-create', [
            'rooms' => $this->getroomsList(),
        ]); }

    public function store(CreateHousekeepingAction $action)
    {
        $this->validate();
        $dto = HousekeepingDTO::fromArray([
            'room_id' => $this->room_id,
            'task' => $this->task,
            'is_completed' => $this->is_completed,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('housekeeping-created', id: $item->id);
        $this->js("Livewire.dispatch('housekeeping-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('hotel-management/housekeepings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['room_id', 'task', 'is_completed']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Housekeeping::rules(); }
}