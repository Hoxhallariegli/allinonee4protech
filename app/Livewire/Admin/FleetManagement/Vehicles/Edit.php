<?php

namespace App\Livewire\Admin\FleetManagement\Vehicles;

use App\Models\FleetManagement\Vehicle;
use App\Domain\FleetManagement\Vehicle\DTOs\VehicleDTO;
use App\Domain\FleetManagement\Vehicle\Actions\UpdateVehicleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Vehicle')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Vehicle $item;
    public $make = '';
    public $model = '';
    public $year = '';
    public $license_plate = '';
    public $photo = '';
   
    public function mount(Vehicle $vehicle) { $this->item = $vehicle; $this->fill($vehicle->toArray());  }
    public function render() {
        abort_if_cannot('edit_vehicles');
        return view('livewire.admin.fleet-management.vehicles.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateVehicleAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/vehicles', 'uploads'); }
 $dto = VehicleDTO::fromArray([
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('fleet-management/vehicles.updated')); return to_route('admin.fleet-management.vehicles.index'); }
    protected function rules(): array { return Vehicle::rules($this->item->id); }
}