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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.real-estate-c-r-m.contracts.quick-create', [
            'properties' => $this->getpropertiesList(),
            'clients' => $this->getclientsList(),
        ]); }

    public function store(CreateContractAction $action)
    {
        $this->validate();
        $dto = ContractDTO::fromArray([
            'property_id' => $this->property_id,
            'client_id' => $this->client_id,
            'amount' => $this->amount,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('contract-created', id: $item->id);
        $this->js("Livewire.dispatch('contract-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('real-estate-c-r-m/contracts.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['property_id', 'client_id', 'amount']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Contract::rules(); }
}