<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleBrands;

use App\Models\AutoRepairManagement\VehicleBrand;
use App\Domain\AutoRepairManagement\VehicleBrand\DTOs\VehicleBrandDTO;
use App\Domain\AutoRepairManagement\VehicleBrand\Actions\CreateVehicleBrandAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add VehicleBrand')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
   
    public function render() { abort_if_cannot('add_vehicle_brands'); return view('livewire.admin.auto-repair-management.vehicle-brands.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateVehicleBrandAction $action) { $this->validate();  $dto = VehicleBrandDTO::fromArray([
            'name' => $this->name,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/vehicle-brands.created')); return to_route('admin.auto-repair-management.vehicle-brands.index'); }
    protected function rules(): array { return VehicleBrand::rules(); }
}