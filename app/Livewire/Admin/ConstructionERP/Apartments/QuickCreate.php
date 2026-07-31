<?php

namespace App\Livewire\Admin\ConstructionERP\Apartments;

use App\Models\ConstructionERP\Apartment;
use App\Domain\ConstructionERP\Apartment\DTOs\ApartmentDTO;
use App\Domain\ConstructionERP\Apartment\Actions\CreateApartmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $building_id = '';
    public $number = '';
    public $area = '';
    public $status = '';
 
    #[On('building-created')] 
    public function refreshBuildings($id) { $this->building_id = $id; $this->updatedBuildingId($id); }
 
    public function updatedBuildingId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Building::find($value);
        if (!$related) return;
    }
 
    protected function getbuildingsList() {
        return \App\Models\ConstructionERP\Building::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.construction-e-r-p.apartments.quick-create', [
            'buildings' => $this->getbuildingsList(),
        ]); }

    public function store(CreateApartmentAction $action)
    {
        $this->validate();
        $dto = ApartmentDTO::fromArray([
            'building_id' => $this->building_id,
            'number' => $this->number,
            'area' => $this->area,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('apartment-created', id: $item->id);
        $this->js("Livewire.dispatch('apartment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/apartments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['building_id', 'number', 'area', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Apartment::rules(); }
}