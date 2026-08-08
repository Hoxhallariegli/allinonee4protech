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

#[Title('Add ClientAddress')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_client_addresses');
        return view('livewire.admin.real-estate-c-r-m.client-addresses.create', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateClientAddressAction $action) { $this->validate();  $dto = ClientAddressDTO::fromArray([
            'client_id' => $this->client_id,
            'address' => $this->address,
        ]); $action->execute($dto); session()->flash('success', __('real-estate-c-r-m/client-addresses.created')); return to_route('admin.real-estate-c-r-m.client-addresses.index'); }
    protected function rules(): array { return ClientAddress::rules(); }
}