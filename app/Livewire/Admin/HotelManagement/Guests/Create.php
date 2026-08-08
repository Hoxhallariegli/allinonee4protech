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

#[Title('Add Guest')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
   
    public function render() {
        abort_if_cannot('add_guests');
        return view('livewire.admin.hotel-management.guests.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateGuestAction $action) { $this->validate();  $dto = GuestDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('hotel-management/guests.created')); return to_route('admin.hotel-management.guests.index'); }
    protected function rules(): array { return Guest::rules(); }
}