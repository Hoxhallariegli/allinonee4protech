<?php

namespace App\Livewire\Admin\VehicleModels;

use App\Models\VehicleModel;
use App\Domain\VehicleModel\DTOs\VehicleModelDTO;
use App\Domain\VehicleModel\Actions\CreateVehicleModelAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add VehicleModel')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $brand_id = '';
 
    #[On('vehicle-brand-created')] 
    public function refreshBrands($id) { $this->brand_id = $id; $this->updatedBrandId($id); }
 
    public function updatedBrandId($value)
    {
        if (!$value) return;
        $related = \App\Models\VehicleBrand::find($value);
        if (!$related) return;
    }
 
    protected function getbrandsList() {
        return \App\Models\VehicleBrand::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_vehicle_models'); return view('livewire.admin.vehicle-models.create', [
            'brands' => $this->getbrandsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateVehicleModelAction $action) { $this->validate();  $dto = VehicleModelDTO::fromArray([
            'name' => $this->name,
            'brand_id' => $this->brand_id,
        ]); $action->execute($dto); session()->flash('success', __('vehicle-models.created')); return to_route('admin.vehicle-models.index'); }
    protected function rules(): array { return VehicleModel::rules(); }
}