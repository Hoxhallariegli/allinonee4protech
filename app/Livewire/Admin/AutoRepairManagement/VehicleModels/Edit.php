<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleModels;

use App\Models\AutoRepairManagement\VehicleModel;
use App\Domain\AutoRepairManagement\VehicleModel\DTOs\VehicleModelDTO;
use App\Domain\AutoRepairManagement\VehicleModel\Actions\UpdateVehicleModelAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit VehicleModel')]
class Edit extends Component
{
        use WithPagination;
 public VehicleModel $item;
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

    public function mount(VehicleModel $vehicleModel) { $this->item = $vehicleModel; $this->fill($vehicleModel->toArray());  }
    public function render() { abort_if_cannot('edit_vehicle_models'); return view('livewire.admin.auto-repair-management.vehicle-models.edit', [
            'brands' => $this->getbrandsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateVehicleModelAction $action) { $this->validate();  $dto = VehicleModelDTO::fromArray([
            'name' => $this->name,
            'brand_id' => $this->brand_id,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/vehicle-models.updated')); return to_route('admin.auto-repair-management.vehicle-models.index'); }
    protected function rules(): array { return VehicleModel::rules($this->item->id); }
}