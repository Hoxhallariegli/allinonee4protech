<?php

namespace App\Livewire\Admin\AutoRepairManagement\Vehicles;

use App\Models\AutoRepairManagement\Vehicle;
use App\Domain\AutoRepairManagement\Vehicle\DTOs\VehicleDTO;
use App\Domain\AutoRepairManagement\Vehicle\Actions\CreateVehicleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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
        $related = \App\Models\AutoRepairManagement\VehicleBrand::find($value);
        if (!$related) return;
    }

    public function updatedModelId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\VehicleModel::find($value);
        if (!$related) return;
    }

    public function updatedCustomerId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Customer::find($value);
        if (!$related) return;
    }
 
    protected function getbrandsList() {
        return \App\Models\AutoRepairManagement\VehicleBrand::pluck('name', 'id')->toArray();
    }

    protected function getmodelsList() {
        return \App\Models\AutoRepairManagement\VehicleModel::pluck('name', 'id')->toArray();
    }

    protected function getcustomersList() {
        return \App\Models\AutoRepairManagement\Customer::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.vehicles.quick-create', [
            'brands' => $this->getbrandsList(),
            'models' => $this->getmodelsList(),
            'customers' => $this->getcustomersList(),
        ]); }

    public function store(CreateVehicleAction $action)
    {
        $this->validate();
        $dto = VehicleDTO::fromArray([
            'brand_id' => $this->brand_id,
            'model_id' => $this->model_id,
            'year' => $this->year,
            'customer_id' => $this->customer_id,
            'license_plate' => $this->license_plate,
            'vin' => $this->vin,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('vehicle-created', id: $item->id);
        $this->js("Livewire.dispatch('vehicle-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/vehicles.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['brand_id', 'model_id', 'year', 'customer_id', 'license_plate', 'vin']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Vehicle::rules(); }
}