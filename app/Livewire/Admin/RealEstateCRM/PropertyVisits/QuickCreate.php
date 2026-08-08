<?php

namespace App\Livewire\Admin\RealEstateCRM\PropertyVisits;

use App\Models\RealEstateCRM\PropertyVisit;
use App\Domain\RealEstateCRM\PropertyVisit\DTOs\PropertyVisitDTO;
use App\Domain\RealEstateCRM\PropertyVisit\Actions\CreatePropertyVisitAction;
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
    public $visit_date = '';
 
    #[On('property-created')] 
    public function refreshProperties($id) { $this->property_id = $id; $this->updatedPropertyId($id); }

    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedPropertyId($value)
    {
        if (!$value) return;
        $related = \App\Models\RealEstateCRM\Property::find($value);
        if (!$related) return;
    }

    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\RealEstateCRM\Client::find($value);
        if (!$related) return;
    }
 
    protected function getpropertiesList() {
        return \App\Models\RealEstateCRM\Property::pluck('title', 'id')->toArray();
    }

    protected function getclientsList() {
        return \App\Models\RealEstateCRM\Client::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.real-estate-c-r-m.property-visits.quick-create', [
            'properties' => $this->getpropertiesList(),
            'clients' => $this->getclientsList(),
        ]); }

    public function store(CreatePropertyVisitAction $action)
    {
        $this->validate();
        $dto = PropertyVisitDTO::fromArray([
            'property_id' => $this->property_id,
            'client_id' => $this->client_id,
            'visit_date' => $this->visit_date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('property-visit-created', id: $item->id);
        $this->js("Livewire.dispatch('property-visit-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('real-estate-c-r-m/property-visits.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['property_id', 'client_id', 'visit_date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return PropertyVisit::rules(); }
}