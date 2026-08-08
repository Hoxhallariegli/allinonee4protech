<?php

namespace App\Livewire\Admin\HotelManagement\Guests;

use App\Models\HotelManagement\Guest;
use App\Domain\HotelManagement\Guest\DTOs\GuestDTO;
use App\Domain\HotelManagement\Guest\Actions\CreateGuestAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.hotel-management.guests.quick-create', [
        ]); }

    public function store(CreateGuestAction $action)
    {
        $this->validate();
        $dto = GuestDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('guest-created', id: $item->id);
        $this->js("Livewire.dispatch('guest-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('hotel-management/guests.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Guest::rules(); }
}