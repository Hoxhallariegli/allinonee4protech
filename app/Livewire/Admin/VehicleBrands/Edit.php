<?php

namespace App\Livewire\Admin\VehicleBrands;

use App\Models\VehicleBrand;
use App\Domain\VehicleBrand\DTOs\VehicleBrandDTO;
use App\Domain\VehicleBrand\Actions\UpdateVehicleBrandAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit VehicleBrand')]
class Edit extends Component
{
        use WithPagination;
 public VehicleBrand $item;
    public $name = '';
   
    public function mount(VehicleBrand $vehicleBrand) { $this->item = $vehicleBrand; $this->fill($vehicleBrand->toArray());  }
    public function render() { abort_if_cannot('edit_vehicle_brands'); return view('livewire.admin.vehicle-brands.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateVehicleBrandAction $action) { $this->validate();  $dto = VehicleBrandDTO::fromArray([
            'name' => $this->name,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('vehicle-brands.updated')); return to_route('admin.vehicle-brands.index'); }
    protected function rules(): array { return VehicleBrand::rules($this->item->id); }
}