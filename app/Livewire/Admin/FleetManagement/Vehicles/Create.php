<?php

namespace App\Livewire\Admin\FleetManagement\Vehicles;

use App\Models\FleetManagement\Vehicle;
use App\Domain\FleetManagement\Vehicle\DTOs\VehicleDTO;
use App\Domain\FleetManagement\Vehicle\Actions\CreateVehicleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Vehicle')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $make = '';
    public $model = '';
    public $year = '';
    public $license_plate = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_vehicles');
        return view('livewire.admin.fleet-management.vehicles.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateVehicleAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/vehicles', 'uploads'); }
 $dto = VehicleDTO::fromArray([
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('fleet-management/vehicles.created')); return to_route('admin.fleet-management.vehicles.index'); }
    protected function rules(): array { return Vehicle::rules(); }
}