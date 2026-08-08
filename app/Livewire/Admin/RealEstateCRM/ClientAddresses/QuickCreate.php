<?php

namespace App\Livewire\Admin\RealEstateCRM\ClientAddresses;

use App\Models\RealEstateCRM\ClientAddress;
use App\Domain\RealEstateCRM\ClientAddress\DTOs\ClientAddressDTO;
use App\Domain\RealEstateCRM\ClientAddress\Actions\CreateClientAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $client_id = '';
    public $address = '';
 
    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\RealEstateCRM\Client::find($value);
        if (!$related) return;
    }
 
    protected function getclientsList() {
        return \App\Models\RealEstateCRM\Client::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.real-estate-c-r-m.client-addresses.quick-create', [
            'clients' => $this->getclientsList(),
        ]); }

    public function store(CreateClientAddressAction $action)
    {
        $this->validate();
        $dto = ClientAddressDTO::fromArray([
            'client_id' => $this->client_id,
            'address' => $this->address,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('client-address-created', id: $item->id);
        $this->js("Livewire.dispatch('client-address-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('real-estate-c-r-m/client-addresses.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['client_id', 'address']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return ClientAddress::rules(); }
}