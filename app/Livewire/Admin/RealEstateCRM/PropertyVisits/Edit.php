<?php

namespace App\Livewire\Admin\RealEstateCRM\PropertyVisits;

use App\Models\RealEstateCRM\PropertyVisit;
use App\Domain\RealEstateCRM\PropertyVisit\DTOs\PropertyVisitDTO;
use App\Domain\RealEstateCRM\PropertyVisit\Actions\UpdatePropertyVisitAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit PropertyVisit')]
class Edit extends Component
{
        use WithPagination;
 public PropertyVisit $item;
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

    public function mount(PropertyVisit $propertyVisit) { $this->item = $propertyVisit; $this->fill($propertyVisit->toArray()); $this->visit_date = $propertyVisit->visit_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_property_visits');
        return view('livewire.admin.real-estate-c-r-m.property-visits.edit', [
            'properties' => $this->getpropertiesList(),
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePropertyVisitAction $action) { $this->validate();  $dto = PropertyVisitDTO::fromArray([
            'property_id' => $this->property_id,
            'client_id' => $this->client_id,
            'visit_date' => $this->visit_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('real-estate-c-r-m/property-visits.updated')); return to_route('admin.real-estate-c-r-m.property-visits.index'); }
    protected function rules(): array { return PropertyVisit::rules($this->item->id); }
}