<?php

namespace App\Livewire\Admin\Vehicles;

use App\Models\Vehicle;
use App\Domain\Vehicle\DTOs\VehicleDTO;
use App\Domain\Vehicle\Actions\UpdateVehicleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Vehicle')]
class Edit extends Component
{
        use WithPagination;
 public Vehicle $item;
    public $brand_id = '';
    public $model_id = '';
    public $year = '';
    public $customer_id = '';
    public $license_plate = '';
    public $vin = '';
 
    #[On('vehicle-brand-created')] 
    public function refreshBrands($id) { $this->brand_id = $id; $this->updatedBrandId($id); }

    #[On('vehicle-model-created')] 
    public function refreshModels($id) { $this->model_id = $id; $this->updatedModelId($id); }

    #[On('customer-created')] 
    public function refreshCustomers($id) { $this->customer_id = $id; $this->updatedCustomerId($id); }
 
    public function updatedBrandId($value)
    {
        if (!$value) return;
        $related = \App\Models\VehicleBrand::find($value);
        if (!$related) return;
        if (isset($related->model_id)) { $this->model_id = $related->model_id; }
        if (isset($related->customer_id)) { $this->customer_id = $related->customer_id; }
    }

    public function updatedModelId($value)
    {
        if (!$value) return;
        $related = \App\Models\VehicleModel::find($value);
        if (!$related) return;
        if (isset($related->brand_id)) { $this->brand_id = $related->brand_id; }
        if (isset($related->customer_id)) { $this->customer_id = $related->customer_id; }
    }

    public function updatedCustomerId($value)
    {
        if (!$value) return;
        $related = \App\Models\Customer::find($value);
        if (!$related) return;
        if (isset($related->brand_id)) { $this->brand_id = $related->brand_id; }
        if (isset($related->model_id)) { $this->model_id = $related->model_id; }
    }
 
    protected function getbrandsList() {
        return \App\Models\VehicleBrand::pluck('name', 'id')->toArray();
    }

    protected function getmodelsList() {
        return \App\Models\VehicleModel::pluck('name', 'id')->toArray();
    }

    protected function getcustomersList() {
        return \App\Models\Customer::pluck('name', 'id')->toArray();
    }

    public function mount(Vehicle $vehicle) { $this->item = $vehicle; $this->fill($vehicle->toArray());  }
    public function render() { abort_if_cannot('edit_vehicles'); return view('livewire.admin.vehicles.edit', [
            'brands' => $this->getbrandsList(),
            'models' => $this->getmodelsList(),
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateVehicleAction $action) { $this->validate();  $dto = VehicleDTO::fromArray([
            'brand_id' => $this->brand_id,
            'model_id' => $this->model_id,
            'year' => $this->year,
            'customer_id' => $this->customer_id,
            'license_plate' => $this->license_plate,
            'vin' => $this->vin,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('vehicles.updated')); return to_route('admin.vehicles.index'); }
    protected function rules(): array { return Vehicle::rules($this->item->id); }
}