<?php

namespace App\Livewire\Admin\HotelManagement\Guests;

use App\Models\HotelManagement\Guest;
use App\Domain\HotelManagement\Guest\DTOs\GuestDTO;
use App\Domain\HotelManagement\Guest\Actions\UpdateGuestAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Guest')]
class Edit extends Component
{
        use WithPagination;
 public Guest $item;
    public $name = '';
    public $email = '';
   
    public function mount(Guest $guest) { $this->item = $guest; $this->fill($guest->toArray());  }
    public function render() {
        abort_if_cannot('edit_guests');
        return view('livewire.admin.hotel-management.guests.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateGuestAction $action) { $this->validate();  $dto = GuestDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('hotel-management/guests.updated')); return to_route('admin.hotel-management.guests.index'); }
    protected function rules(): array { return Guest::rules($this->item->id); }
}