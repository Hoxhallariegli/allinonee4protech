<?php

namespace App\Livewire\Admin\RealEstateCRM\Contracts;

use App\Models\RealEstateCRM\Contract;
use App\Domain\RealEstateCRM\Contract\DTOs\ContractDTO;
use App\Domain\RealEstateCRM\Contract\Actions\CreateContractAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Contract')]
class Create extends Component
{
        use WithPagination;
     public $property_id = '';
    public $client_id = '';
    public $amount = '';
 
    #[On('property-created')] 
    public function refreshProperties($id) { $this->property_id = $id; $this->updatedPropertyId($id); }

    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedPropertyId($value)
    {
        if (!$value) return;
        $related = \App\Models\RealEstateCRM\Property::find($value);
        if (!$related) return;
        if (isset($related->client_id)) { $this->client_id = $related->client_id; }
    }

    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Client::find($value);
        if (!$related) return;
        if (isset($related->property_id)) { $this->property_id = $related->property_id; }
    }
 
    protected function getpropertiesList() {
        return \App\Models\RealEstateCRM\Property::pluck('title', 'id')->toArray();
    }

    protected function getclientsList() {
        return \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_contracts'); return view('livewire.admin.real-estate-c-r-m.contracts.create', [
            'properties' => $this->getpropertiesList(),
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateContractAction $action) { $this->validate();  $dto = ContractDTO::fromArray([
            'property_id' => $this->property_id,
            'client_id' => $this->client_id,
            'amount' => $this->amount,
        ]); $action->execute($dto); session()->flash('success', __('real-estate-c-r-m/contracts.created')); return to_route('admin.real-estate-c-r-m.contracts.index'); }
    protected function rules(): array { return Contract::rules(); }
}