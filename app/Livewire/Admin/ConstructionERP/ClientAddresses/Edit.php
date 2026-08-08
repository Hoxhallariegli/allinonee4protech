<?php

namespace App\Livewire\Admin\ConstructionERP\ClientAddresses;

use App\Models\ConstructionERP\ClientAddress;
use App\Domain\ConstructionERP\ClientAddress\DTOs\ClientAddressDTO;
use App\Domain\ConstructionERP\ClientAddress\Actions\UpdateClientAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit ClientAddress')]
class Edit extends Component
{
        use WithPagination;
 public ClientAddress $item;
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

    public function mount(ClientAddress $clientAddress) { $this->item = $clientAddress; $this->fill($clientAddress->toArray());  }
    public function render() {
        abort_if_cannot('edit_client_addresses');
        return view('livewire.admin.construction-e-r-p.client-addresses.edit', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateClientAddressAction $action) { $this->validate();  $dto = ClientAddressDTO::fromArray([
            'client_id' => $this->client_id,
            'address' => $this->address,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/client-addresses.updated')); return to_route('admin.construction-e-r-p.client-addresses.index'); }
    protected function rules(): array { return ClientAddress::rules($this->item->id); }
}