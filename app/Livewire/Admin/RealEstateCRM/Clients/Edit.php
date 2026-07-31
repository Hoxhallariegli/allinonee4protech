<?php

namespace App\Livewire\Admin\RealEstateCRM\Clients;

use App\Models\RealEstateCRM\Client;
use App\Domain\RealEstateCRM\Client\DTOs\ClientDTO;
use App\Domain\RealEstateCRM\Client\Actions\UpdateClientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Client')]
class Edit extends Component
{
        use WithPagination;
 public Client $item;
    public $name = '';
    public $phone = '';
    public $email = '';
   
    public function mount(Client $client) { $this->item = $client; $this->fill($client->toArray());  }
    public function render() { abort_if_cannot('edit_clients'); return view('livewire.admin.real-estate-c-r-m.clients.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateClientAction $action) { $this->validate();  $dto = ClientDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('real-estate-c-r-m/clients.updated')); return to_route('admin.real-estate-c-r-m.clients.index'); }
    protected function rules(): array { return Client::rules($this->item->id); }
}