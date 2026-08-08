<?php

namespace App\Livewire\Admin\FacilityManagement\Buildings;

use App\Models\FacilityManagement\Building;
use App\Domain\FacilityManagement\Building\DTOs\BuildingDTO;
use App\Domain\FacilityManagement\Building\Actions\CreateBuildingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $address = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.facility-management.buildings.quick-create', [
        ]); }

    public function store(CreateBuildingAction $action)
    {
        $this->validate();
        $dto = BuildingDTO::fromArray([
            'name' => $this->name,
            'address' => $this->address,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('building-created', id: $item->id);
        $this->js("Livewire.dispatch('building-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('facility-management/buildings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'address']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Building::rules(); }
}