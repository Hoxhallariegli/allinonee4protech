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

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $base_price = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.hotel-management.room-types.quick-create', [
        ]); }

    public function store(CreateRoomTypeAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/room-types', 'uploads'); }
        $dto = RoomTypeDTO::fromArray([
            'name' => $this->name,
            'base_price' => $this->base_price,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('room-type-created', id: $item->id);
        $this->js("Livewire.dispatch('room-type-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('hotel-management/room-types.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'base_price', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return RoomType::rules(); }
}