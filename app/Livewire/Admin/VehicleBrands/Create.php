<?php

namespace App\Livewire\Admin\VehicleBrands;

use App\Models\VehicleBrand;
use App\Domain\VehicleBrand\DTOs\VehicleBrandDTO;
use App\Domain\VehicleBrand\Actions\CreateVehicleBrandAction;
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
   
    public function render() { abort_if_cannot('add_vehicle_brands'); return view('livewire.admin.vehicle-brands.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateVehicleBrandAction $action) { $this->validate();  $dto = VehicleBrandDTO::fromArray([
            'name' => $this->name,
        ]); $action->execute($dto); session()->flash('success', __('vehicle-brands.created')); return to_route('admin.vehicle-brands.index'); }
    protected function rules(): array { return VehicleBrand::rules(); }
}