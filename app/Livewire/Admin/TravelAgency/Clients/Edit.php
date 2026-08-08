<?php

namespace App\Livewire\Admin\TravelAgency\Clients;

use App\Models\TravelAgency\Client;
use App\Domain\TravelAgency\Client\DTOs\ClientDTO;
use App\Domain\TravelAgency\Client\Actions\UpdateClientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Client')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Client $item;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $photo = '';
   
    public function mount(Client $client) { $this->item = $client; $this->fill($client->toArray());  }
    public function render() {
        abort_if_cannot('edit_clients');
        return view('livewire.admin.travel-agency.clients.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateClientAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/clients', 'uploads'); }
 $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('travel-agency/clients.updated')); return to_route('admin.travel-agency.clients.index'); }
    protected function rules(): array { return Client::rules($this->item->id); }
}