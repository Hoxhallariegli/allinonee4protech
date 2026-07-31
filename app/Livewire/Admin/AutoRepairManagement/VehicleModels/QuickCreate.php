<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleModels;

use App\Models\AutoRepairManagement\VehicleModel;
use App\Domain\AutoRepairManagement\VehicleModel\DTOs\VehicleModelDTO;
use App\Domain\AutoRepairManagement\VehicleModel\Actions\CreateVehicleModelAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $brand_id = '';
 
    #[On('vehicle-brand-created')] 
    public function refreshBrands($id) { $this->brand_id = $id; $this->updatedBrandId($id); }
 
    public function updatedBrandId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\VehicleBrand::find($value);
        if (!$related) return;
    }
 
    protected function getbrandsList() {
        return \App\Models\AutoRepairManagement\VehicleBrand::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.vehicle-models.quick-create', [
            'brands' => $this->getbrandsList(),
        ]); }

    public function store(CreateVehicleModelAction $action)
    {
        $this->validate();
        $dto = VehicleModelDTO::fromArray([
            'name' => $this->name,
            'brand_id' => $this->brand_id,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('vehicle-model-created', id: $item->id);
        $this->js("Livewire.dispatch('vehicle-model-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/vehicle-models.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'brand_id']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return VehicleModel::rules(); }
}