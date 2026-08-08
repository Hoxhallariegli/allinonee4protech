<?php

namespace App\Livewire\Admin\ConstructionERP\ClientAddresses;

use App\Models\ConstructionERP\ClientAddress;
use App\Domain\ConstructionERP\ClientAddress\DTOs\ClientAddressDTO;
use App\Domain\ConstructionERP\ClientAddress\Actions\CreateClientAddressAction;
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
        $related = \App\Models\ConstructionERP\Client::find($value);
        if (!$related) return;
    }
 
    protected function getclientsList() {
        return \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_client_addresses');
        return view('livewire.admin.construction-e-r-p.client-addresses.create', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateClientAddressAction $action) { $this->validate();  $dto = ClientAddressDTO::fromArray([
            'client_id' => $this->client_id,
            'address' => $this->address,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/client-addresses.created')); return to_route('admin.construction-e-r-p.client-addresses.index'); }
    protected function rules(): array { return ClientAddress::rules(); }
}